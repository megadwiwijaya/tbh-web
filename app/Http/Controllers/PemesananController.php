<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesananPenginapan = Pemesanan::whereNotNull('id_kamar')->get();
        $pemesananTrip = Pemesanan::whereNotNull('id_trip_wisata')->get();

        // Status manual (karena tidak ada tabel status)
         $daftarStatus = ['', 'check_in', 'check_out'];

        return view('admin.pemesanan.index', compact('pemesananPenginapan', 'pemesananTrip', 'daftarStatus'));
    }

    public function ubahStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        Pemesanan::where('id_pemesanan', $id)->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }
}
