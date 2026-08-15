<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Form Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses Login & Redirection Berdasarkan Role
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Logika Redirection Berdasarkan Peran Pengguna
            return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'panitia' => redirect()->route('panitia.verification.index'),
                'pendaftar' => redirect()->route('student.dashboard'),
                default => redirect()->route('landing'),
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Form Registrasi (Khusus Pendaftar / Orang Tua)
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses Registrasi Akun Pendaftar
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email tersebut sudah terdaftar. Silakan masuk atau gunakan email lain.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pendaftar', // Otomatis diset sebagai pendaftar
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('student.dashboard')->with('success', 'Akun berhasil dibuat! Silakan lengkapi biodata Anda.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}

