<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class AdminPembayaranController extends Controller
{
    public function index()
    {
        // Ambil semua data pembayaran, dengan relasi ke pemesanan dan user
        $pembayaran = Pembayaran::with(['pemesanan.user'])->get();

        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = $request->status;
        $pembayaran->save();

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

}
