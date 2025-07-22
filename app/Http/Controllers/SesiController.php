<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    public function index()
    {
        return view('login'); // pastikan file login.blade.php ada
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        // Coba login
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Arahkan berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'pelanggan') {
                return redirect()->route('pelanggan.profil'); // ganti ke profil pelanggan
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors('Akun tidak memiliki hak akses yang sesuai.');
            }
        }

        // Jika gagal login
        return redirect()->route('login')->withErrors('Email atau password salah')->withInput();
    }

        public function logout(Request $request)
        {
            Auth::logout(); // Logout user

            // Invalidate session & regenerate token (untuk keamanan)
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Berhasil logout');
        }
}
