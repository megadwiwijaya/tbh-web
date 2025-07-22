<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilPelangganController extends Controller
{
public function index()
    {
        return view('pelanggan.profil');
    }

public function update(Request $request)
{
    $user = auth()->user();
    $user->update([
        'nama' => $request->nama,
        'email' => $request->email,
        // dan lainnya
    ]);

    return redirect()->route('pelanggan.profil')->with('success', 'Profil berhasil diperbarui!');
}
   
}
