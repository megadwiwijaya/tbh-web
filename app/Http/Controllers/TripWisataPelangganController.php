<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripWisata;

class TripWisataPelangganController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->tanggal; // untuk ditampilkan saja
        $trips = TripWisata::all(); // tampilkan semua trip

    return view('pelanggan.trip-tersedia', compact('trips', 'tanggal'));
    }

    public function show($id)
{
    $trip_wisata = TripWisata::where('id_trip_wisata', $id)->firstOrFail();
    return view('pelanggan.detail-trip', compact('trip_wisata'));
}

}
