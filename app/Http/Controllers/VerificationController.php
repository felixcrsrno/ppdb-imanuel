<?php

namespace App\Http\Controllers;

use App\Events\RegistrationStatusChanged;
use App\Models\Registration;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index()
    {
        $q = request()->input('search');
        $status = request()->input('status');
        $unit = request()->input('unit');
        $dateFrom = request()->input('date_from');
        $dateTo = request()->input('date_to');

        $query = Registration::with(['user', 'studentProfile', 'documents'])
            ->when($q, function($builder, $q) {
                $builder->where(function ($search) use ($q) {
                    $search->whereHas('user', function($u) use ($q) {
                        $u->where('name', 'like', "%{$q}%");
                    })->orWhere('registration_number', 'like', "%{$q}%");
                });
            })
            ->when($status, function($builder, $status) {
                $builder->where('status', $status);
            })
            ->when($unit, function($builder, $unit) {
                $builder->where('unit', $unit);
            })
            ->when($dateFrom, function($builder, $dateFrom) {
                $builder->whereDate('created_at', '>=', $dateFrom);
            })
            ->when($dateTo, function($builder, $dateTo) {
                $builder->whereDate('created_at', '<=', $dateTo);
            })
            ->latest();

        $perPage = request()->input('per_page', 15);
        $registrations = $query->paginate($perPage)->withQueryString();

        // Simple stats
        $stats = [
            'total' => Registration::count(),
            'pending' => Registration::where('status','pending')->count(),
            'verified' => Registration::where('status','verified')->count(),
            'accepted' => Registration::where('status','passed')->count(),
            'rejected' => Registration::whereIn('status',['rejected', 'failed'])->count(),
        ];

        $lastUpdated = Registration::latest('updated_at')->first()?->updated_at?->format('d M Y H:i');
        $currentBatch = null;

        return view('admin.verification', compact('registrations','stats','lastUpdated','currentBatch'));
    }

    public function show($id)
    {
        $registration = Registration::with(['user', 'studentProfile', 'documents'])->findOrFail($id);

        return view('admin.verification-show', compact('registration'));
    }

    public function updateStatus(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        $request->validate([
            'status' => ['required', 'in:pending,verified,rejected,passed,failed'],
        ]);

        $oldStatus = $registration->status;
        $newStatus = $request->status;

        $registration->update(['status' => $newStatus]);

        // Dispatch event untuk mengirim email notifikasi
        event(new RegistrationStatusChanged($registration, $oldStatus, $newStatus));

        return back()->with('success', 'Status pendaftaran berhasil diperbarui dan notifikasi email telah dikirim.');
    }
}

