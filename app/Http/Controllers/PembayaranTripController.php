<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PembayaranTripController extends Controller
{
    /**
     * Menampilkan halaman pembayaran trip wisata
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::with('tripWisata')->findOrFail($id); // Load relasi tripWisata
        return view('pelanggan.pembayaran-trip', compact('pemesanan'));
    }
    
    /**
     * Memproses pengiriman pembayaran trip wisata
     */
    public function proses(Request $request, $id)
    {
        $request->validate([
            'bukti_dp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bukti_lunas' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'metode' => 'required|in:DP,Lunas',
        ]);

        $pemesanan = Pemesanan::with('tripWisata')->findOrFail($id);

        // ID pembayaran dengan format TRW + DDMMYYYY + 4 karakter random
        $date = date('dmY'); // Format: DDMMYYYY (8 karakter)
        $randomCode = strtoupper(Str::random(4)); // 4 karakter random
        $idPembayaran = 'TRW' . $date . $randomCode;

        // PERBAIKAN: Hitung total harga yang benar dari jumlah_orang × harga_per_orang
        $totalHarga = $pemesanan->jumlah_orang * $pemesanan->tripWisata->harga;

        // PERBAIKAN: Tentukan total_bayar dan sisa_tagihan berdasarkan metode
        if ($request->metode == 'DP') {
            $totalBayar = $totalHarga * 0.5; // 50% dari total harga
            $sisaTagihan = $totalHarga - $totalBayar; // Sisa 50%
        } else { // Lunas
            $totalBayar = $totalHarga; // 100% dari total harga
            $sisaTagihan = 0; // Tidak ada sisa
        }

        // Tentukan bukti yang digunakan berdasarkan metode
        $buktiPath = null;
        if ($request->metode == 'DP' && $request->hasFile('bukti_dp')) {
            $buktiPath = $request->file('bukti_dp')->store('bukti_pembayaran', 'public');
        } elseif ($request->metode == 'Lunas' && $request->hasFile('bukti_lunas')) {
            $buktiPath = $request->file('bukti_lunas')->store('bukti_pembayaran', 'public');
        }

        // Simpan data pembayaran dengan nilai yang sudah dihitung
        $pembayaran = Pembayaran::create([
            'id_pembayaran' => $idPembayaran,
            'tanggal' => now(),
            'bukti' => $buktiPath,
            'keterangan' => $request->metode,
            'status' => 'pending',
            'total_bayar' => $totalBayar,        // Menggunakan nilai yang dihitung
            'sisa_tagihan' => $sisaTagihan,      // Menggunakan nilai yang dihitung
            'id_pemesanan' => $pemesanan->id_pemesanan,
        ]);

        // Hubungkan ke pemesanan
        $pemesanan->id_pembayaran = $pembayaran->id_pembayaran;
        $pemesanan->save();

        return redirect()->route('beranda')->with('success', 'Pembayaran berhasil dikirim. Silakan tunggu konfirmasi dari admin.');
    }
}