<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\TripWisata;
use App\Models\PemesananKamar;
use Carbon\Carbon;

class BerandaController extends Controller
{
    public function index()
    {
        $tanggal = Carbon::now()->toDateString(); // Hari ini
        return view('beranda', compact('tanggal'));
    }

    public function cariKamar(Request $request)
    {
        $checkIn = $request->check_in;
        $checkOut = $request->check_out;

        // Ambil semua kamar yang tidak bentrok dengan tanggal check-in dan check-out
        $kamar = Kamar::whereDoesntHave('pemesanans', function ($query) use ($checkIn, $checkOut) {
            $query->where(function ($q) use ($checkIn, $checkOut) {
                $q->where('check_in', '<', $checkOut)
                  ->where('check_out', '>', $checkIn);
            });
        })->get();

        return view('hasil-kamar', compact('kamar', 'checkIn', 'checkOut'));
    }

    public function cariTrip(Request $request)
    {
        $tanggal = $request->tanggal;

        $trips = TripWisata::where('tanggal_keberangkatan', $tanggal)->get();

        return view('hasil-trip', compact('trips', 'tanggal'));
    }
}
