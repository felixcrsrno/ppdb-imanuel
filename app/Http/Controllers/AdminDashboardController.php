<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalPendaftar = User::where('role', 'pendaftar')->count();
        $totalRegistrations = Registration::count();
        $registrationsByUnit = Registration::selectRaw('unit, count(*) as total')
            ->groupBy('unit')
            ->pluck('total', 'unit');
        $registrationsByStatus = Registration::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $tkCount = $registrationsByUnit->get('TK', 0);
        $sdCount = $registrationsByUnit->get('SD', 0);
        $smpCount = $registrationsByUnit->get('SMP', 0);
        $pendingCount = $registrationsByStatus->get('pending', 0);
        $verifiedCount = $registrationsByStatus->get('verified', 0);
        $rejectedCount = $registrationsByStatus->get('rejected', 0);
        $recentStudents = User::where('role', 'pendaftar')
            ->with(['registration.studentProfile'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'totalRegistrations',
            'registrationsByUnit',
            'registrationsByStatus',
            'tkCount',
            'sdCount',
            'smpCount',
            'pendingCount',
            'verifiedCount',
            'rejectedCount',
            'recentStudents'
        ));
    }

    public function exportReport()
    {
        $registrations = Registration::with(['user', 'studentProfile'])->orderBy('unit')->get();

        $filename = 'ppdb-report-' . now()->format('Ymd') . '.csv';

        $callback = function () use ($registrations) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['No', 'Nama', 'Email', 'Unit', 'Status', 'Nomor Registrasi']);

            foreach ($registrations as $index => $registration) {
                fputcsv($handle, [
                    $index + 1,
                    $registration->user->name,
                    $registration->user->email,
                    $registration->unit,
                    $registration->status,
                    $registration->registration_number,
                ]);
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
}

