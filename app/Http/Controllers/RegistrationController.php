<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function index()
    {
        $registration = Registration::with(['studentProfile', 'documents'])
            ->where('user_id', Auth::id())
            ->first();

        return view('student.dashboard', compact('registration'));
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'unit' => ['required', 'in:TK,SD,SMP'],
            'full_name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'digits:16'],
            'gender' => ['required', 'in:L,P'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'address' => ['required', 'string'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_phone' => ['required', 'string', 'max:20'],
            'parent_job' => ['required', 'string', 'max:255'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari tepat 16 digit angka.',
        ]);

        $registration = Registration::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'registration_number' => 'PPDB-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4)),
                'unit' => 'SD',
                'status' => 'pending',
            ]
        );

        $registration->studentProfile()->updateOrCreate([], $request->only([
            'full_name',
            'nik',
            'gender',
            'birth_place',
            'birth_date',
            'address',
            'parent_name',
            'parent_phone',
            'parent_job',
        ]));

        return back()->with('success', 'Biodata berhasil disimpan.');
    }

    public function uploadDocument(Request $request)
    {
        $request->validate([
            'file_type' => ['required', 'in:akta,kk,ijazah_rapor,pasfoto'],
            'document' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ]);

        $registration = Registration::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'registration_number' => 'PPDB-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4)),
                'unit' => 'SD',
                'status' => 'pending',
            ]
        );

        $file = $request->file('document');
        $filename = now()->format('YmdHis') . '_' . $request->file_type . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('ppdb_documents/' . Auth::id(), $filename, 'public');

        $registration->documents()->create([
            'file_type' => $request->file_type,
            'file_path' => $path,
        ]);

        return back()->with('success', 'Berkas berhasil diunggah.');
    }
}

