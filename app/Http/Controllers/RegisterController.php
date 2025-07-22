<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Menampilkan form registrasi
    public function show()
    {
        return view('register');
    }

    // Menyimpan data registrasi
public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required|email|unique:users,email',
        'nama' => 'required|string|max:255',
        'password' => 'required|confirmed|min:6',
        'alamat' => 'nullable|string|max:255',
        'no_hp' => 'nullable|string|max:15',
    ]);

    // Generate ID USER otomatis seperti A001, A002
    $lastUser = User::latest('id_user')->first();
    if ($lastUser) {
        $lastNumber = intval(substr($lastUser->id_user, 1)); // ambil angka dari A001
        $newId = 'A' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $newId = 'A001';
    }

    // Simpan user baru
    User::create([
        'id_user' => $newId,
        'email' => $request->email,
        'nama' => $request->nama,
        'password' => Hash::make($request->password),
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
        'role' => 'pelanggan', // default role pelanggan
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
}
}
