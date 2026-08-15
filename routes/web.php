<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC LANDING PAGE (Tamu / Guest)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('public.landing');
})->name('landing');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES (Login, Register, Logout)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php'; 

/*
|--------------------------------------------------------------------------
| 2. AREA CALON PESERTA DIDIK / ORANG TUA (ROLE: PENDAFTAR)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pendaftar'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [RegistrationController::class, 'index'])->name('dashboard');
    Route::post('/register-unit', [RegistrationController::class, 'storeUnit'])->name('unit.store');
    Route::post('/profile', [RegistrationController::class, 'storeProfile'])->name('profile.store');
    Route::post('/document/upload', [RegistrationController::class, 'uploadDocument'])->name('document.upload');
});

/*
|--------------------------------------------------------------------------
| 3. AREA PANITIA PPDB & ADMIN (VERIFIKASI & SELEKSI)
| Catatan: Admin diizinkan mengakses verifikasi panitia
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:panitia,admin'])->prefix('panitia')->name('panitia.')->group(function () {
    Route::get('/verification', [VerificationController::class, 'index'])->name('verification.index');
    Route::get('/verification/{id}', [VerificationController::class, 'show'])->name('verification.show');
    Route::get('/verification/{id}/status', function ($id) {
        return redirect()->route('panitia.verification.show', $id)
            ->with('error', 'Status pendaftaran hanya dapat diubah melalui formulir verifikasi.');
    })->name('verification.status.redirect');
    Route::patch('/verification/{id}/status', [VerificationController::class, 'updateStatus'])->name('verification.update-status');
});

/*
|--------------------------------------------------------------------------
| 4. AREA ADMIN / PIMPINAN YAYASAN (STATISTIK & LAPORAN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/reports/export', [AdminDashboardController::class, 'exportReport'])->name('reports.export');
});

