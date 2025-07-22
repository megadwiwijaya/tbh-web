<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripWisata;

class DetailTripWisataController extends Controller
{
    public function show($id)
{
    $trip_wisata = TripWisata::where('id_trip_wisata', $id)->firstOrFail();
    return view('pelanggan.detail-trip', compact('trip_wisata'));
}   
}
