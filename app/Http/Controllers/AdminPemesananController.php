<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class AdminPemesananController extends Controller
{
    public function index()
    {
        // Ambil semua data pemesanan, dengan relasi user, kamar, trip
        $pemesanan = Pemesanan::with(['user', 'kamar', 'tripWisata'])->get();
        return view('admin.pemesanan.index', compact('pemesanan'));
    }

public function updateStatus(Request $request, $id)
{
    $validated = $request->validate([
        'status' => 'required|in:berlangsung,check_in,check_out,selesai'        
    ]);

    $pemesanan = Pemesanan::with('kamar')->findOrFail($id);
    $pemesanan->status = $validated['status'];
    $pemesanan->save();

    // Jika status jadi check_out dan pemesanan berkaitan dengan kamar
    if ($validated['status'] === 'check_out' && $pemesanan->kamar) {
        $pemesanan->kamar->status = 'tersedia';
        $pemesanan->kamar->save();
    }

    return redirect()->back()->with('success', 'Status pemesanan berhasil diperbarui.');
}

}
