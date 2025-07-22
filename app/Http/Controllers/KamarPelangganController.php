<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Pemesanan;

class KamarPelangganController extends Controller
{
    public function index(Request $request)
    {
        $checkin = $request->checkin;
        $checkout = $request->checkout;

        // Validasi: jika tanggal belum dipilih, kembali ke halaman sebelumnya
        if (!$checkin || !$checkout) {
            return redirect()->back()->withErrors('Silakan pilih tanggal check-in dan check-out terlebih dahulu.');
        }

        // Ambil ID kamar yang sudah dipesan pada rentang tanggal tersebut
        $kamarTerpesan = Pemesanan::whereNotNull('id_kamar') // pastikan hanya pesanan kamar
            ->where(function ($query) use ($checkin, $checkout) {
                $query->whereBetween('tanggal_mulai', [$checkin, $checkout])
                      ->orWhereBetween('tanggal_selesai', [$checkin, $checkout])
                      ->orWhere(function ($query) use ($checkin, $checkout) {
                          $query->where('tanggal_mulai', '<=', $checkin)
                                ->where('tanggal_selesai', '>=', $checkout);
                      });
            })
            ->pluck('id_kamar');

        // Ambil kamar yang tidak sedang dipesan pada tanggal tersebut
        $kamar = Kamar::whereNotIn('id_kamar', $kamarTerpesan)->get();

        return view('pelanggan.kamar-tersedia', compact('kamar', 'checkin', 'checkout'));
    }

    public function show($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('pelanggan.detail-kamar', compact('kamar'));
    }
}
