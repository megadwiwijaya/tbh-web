<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PembayaranKamarController extends Controller
{
    public function show($id)
    {
        // Cari pemesanan berdasarkan id_pemesanan
        $pemesanan = Pemesanan::with('kamar')->where('id_pemesanan', $id)->first();
        
        if (!$pemesanan) {
            return redirect()->route('beranda')->with('error', 'Pemesanan tidak ditemukan');
        }

        return view('pelanggan.pembayaran-kamar', compact('pemesanan'));
    }

    /**
     * Memproses pengiriman pembayaran kamar
     */
public function proses(Request $request, $id)
{
    try {
        $request->validate([
            'metode' => 'required|in:DP,Lunas',
        ]);

        $pemesanan = Pemesanan::with('kamar')->where('id_pemesanan', $id)->first();
        if (!$pemesanan) {
            return back()->with('error', 'Pemesanan tidak ditemukan');
        }

        $durasi = Carbon::parse($pemesanan->tanggal_mulai)->diffInDays(Carbon::parse($pemesanan->tanggal_selesai)) ?: 1;
        $totalHarga = $durasi * $pemesanan->kamar->harga;

        $buktiPath = null;
        if ($request->metode === 'DP') {
            if (!$request->hasFile('bukti_dp')) {
                return back()->with('error', 'Bukti pembayaran DP diperlukan');
            }
            $request->validate([
                'bukti_dp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $buktiPath = $request->file('bukti_dp')->store('bukti_pembayaran', 'public');
            $totalBayar = $totalHarga / 2;
            $sisaTagihan = $totalHarga - $totalBayar;
        } else {
            if (!$request->hasFile('bukti_lunas')) {
                return back()->with('error', 'Bukti pembayaran Lunas diperlukan');
            }
            $request->validate([
                'bukti_lunas' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $buktiPath = $request->file('bukti_lunas')->store('bukti_pembayaran', 'public');
            $totalBayar = $totalHarga;
            $sisaTagihan = 0;
        }

        $idPembayaran = 'KMR' . now()->format('dmY') . strtoupper(Str::random(4));

        Pembayaran::create([
            'id_pembayaran' => $idPembayaran,
            'tanggal' => now()->toDateString(),
            'bukti' => $buktiPath,
            'keterangan' => $request->metode,
            'status' => 'pending',
            'total_bayar' => $totalBayar,
            'sisa_tagihan' => $sisaTagihan,
            'id_pemesanan' => $pemesanan->id_pemesanan,
        ]);

        $pemesanan->update(['id_pembayaran' => $idPembayaran]);

        return redirect()->route('beranda')->with('success', 'Pembayaran berhasil dikirim!');
    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
}