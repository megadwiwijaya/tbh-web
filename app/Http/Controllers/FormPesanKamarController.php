<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Kamar; // Ganti dengan model kamar Anda
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FormPesanKamarController extends Controller
{
    /**
     * Menampilkan form pemesanan kamar.
     */
    public function create(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id); // Ganti dengan model kamar
        $checkin = $request->query('checkin', Carbon::now()->format('Y-m-d')); // Default hari ini
        $checkout = $request->query('checkout', Carbon::now()->addDay()->format('Y-m-d')); // Default +1 hari

        return view('pelanggan.form-pesan-kamar', [
            'kamar' => $kamar,
            'checkin' => $checkin,
            'checkout' => $checkout,
        ]);
    }

    /**
     * Menyimpan data pemesanan kamar, lalu arahkan ke pembayaran atau keranjang.
     */
    public function store(Request $request)
    {
        // Validasi data form
        $request->validate([
            'id_kamar' => 'required|exists:kamar,id_kamar', // Sesuaikan dengan kolom kamar
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'action' => 'required|in:pesan', // Hanya "pesan" berdasarkan view
        ]);

        $kamar = Kamar::findOrFail($request->id_kamar);
        $durasi = Carbon::parse($request->check_in)->diffInDays(Carbon::parse($request->check_out)) ?: 1;
        $totalHarga = $durasi * $kamar->harga;

        $idPemesanan = 'PSN' . now()->format('dmY') . strtoupper(Str::random(2));

        // Simpan data pemesanan
        $pemesanan = Pemesanan::create([
            'id_pemesanan' => $idPemesanan,
            'id_user' => Auth::id(),
            'id_kamar' => $kamar->id_kamar,
            'tanggal_mulai' => $request->check_in,
            'tanggal_selesai' => $request->check_out,
            'total' => $totalHarga,
            'status' => 'berlangsung',
        ]);

        // Redirect ke pembayaran jika action adalah 'pesan'
        if ($request->action === 'pesan') {
            return redirect()->route('pembayaran.kamar.show', ['id' => $idPemesanan])
                ->with('success', 'Pemesanan berhasil, silakan lakukan pembayaran.');
        }

        return redirect()->back()->with('success', 'Pemesanan berhasil ditambahkan.');
    }
}