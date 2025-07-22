<?php

namespace App\Http\Controllers;

use App\Models\TripWisata;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FormPesanTripWisataController extends Controller
{
    /**
     * Menampilkan form pemesanan trip wisata.
     */
    public function create(Request $request, $id)
    {
        $trip = TripWisata::findOrFail($id);
        $tanggal = $request->query('tanggal'); // dari URL

        return view('pelanggan.form-pesan-trip', [
            'trip_wisata' => $trip,
            'tanggal' => $tanggal,
        ]);
    }

    /**
     * Menyimpan data pemesanan trip wisata, lalu arahkan ke pembayaran atau keranjang.
     */
    public function store(Request $request)
    {
        // Validasi data form
        $request->validate([
            'id' => 'required|exists:trip_wisata,id_trip_wisata',
            'tanggal' => 'required|date',
            'jumlah_orang' => 'required|integer|min:1',
            'total' => 'required|numeric',
        ]);

        $trip = TripWisata::findOrFail($request->id);

        // Hitung total berdasarkan harga dan jumlah orang
        $totalHarga = $trip->harga * $request->jumlah_orang;

        // ID pemesanan dengan format: PSN + tanggal + 2 huruf acak
        $idPemesanan = 'PSN' . now()->format('dmY') . strtoupper(Str::random(2));

        // Simpan data pemesanan
        $pemesanan = Pemesanan::create([
            'id_pemesanan' => $idPemesanan,
            'id_user' => Auth::id(),
            'id_trip_wisata' => $trip->id_trip_wisata,
            'tanggal_mulai' => $request->tanggal,
            'tanggal_selesai' => $request->tanggal, // 1 hari
            'jumlah_orang' => $request->jumlah_orang,
            'total' => $totalHarga, // Gunakan perhitungan dinamis
            'status' => 'berlangsung',
        ]);

        // Redirect sesuai aksi
        if ($request->action === 'bayar') {
            return redirect()->route('pembayaran.trip.show', ['id' => $idPemesanan])->with('success', 'Pemesanan berhasil, silakan lakukan pembayaran.');
        }
        return redirect()->back()->with('success', 'Berhasil ditambahkan ke keranjang.');
    }
}