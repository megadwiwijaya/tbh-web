<?php

namespace App\Http\Controllers;

use App\Models\TripWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TripWisataController extends Controller //  class
{
    public function index() // method
    {
        $trips = TripWisata::all();
        return view('admin.trip_wisata.index', compact('trips'));
    }

    public function create()
    {
        return view('admin.trip_wisata.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_trip' => 'required|string|max:255',
            'destinasi' => 'required|string',
            'fasilitas' => 'required|string',
            'harga' => 'required|numeric',
            'foto' => 'required|image|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('trip_wisata', 'public');
        }

        // Generate ID trip otomatis (contoh: TW001)
        $last             = TripWisata::latest('id_trip_wisata')->first();
        $newIdNumber      = $last ? ((int)substr($last->id_trip_wisata, 2)) + 1 : 1;
        $newIdTripWisata  = 'TW' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);

        TripWisata::create([
            'id_trip_wisata' => $newIdTripWisata,
            'nama_trip' => $request->nama_trip,
            'destinasi' => $request->destinasi,
            'fasilitas' => $request->fasilitas,
            'harga' => $request->harga,
            'foto' => $fotoPath
        ]);

        return redirect()->route('trip_wisata.index')->with('success', 'Trip Wisata berhasil ditambahkan');
    }

    public function edit($id_trip_wisata)
    {
        $trip_wisata = TripWisata::where('id_trip_wisata', $id_trip_wisata)->firstOrFail();
        return view('admin.trip_wisata.edit', compact('trip_wisata'));
    }

    public function update(Request $request, $id_trip_wisata) // <-- ganti parameter kedua
    {
    $trip_wisata = TripWisata::where('id_trip_wisata', $id_trip_wisata)->firstOrFail();

    $request->validate([
        'nama_trip' => 'required|string|max:255',
        'destinasi' => 'required|string',
        'fasilitas' => 'required|string',
        'harga' => 'required|numeric',
        'foto' => 'nullable|image|max:2048'
    ]);

    $trip_wisata->nama_trip = $request->nama_trip;
    $trip_wisata->destinasi = $request->destinasi;
    $trip_wisata->fasilitas = $request->fasilitas;
    $trip_wisata->harga = $request->harga;

    if ($request->hasFile('foto')) {
        if ($trip_wisata->foto && Storage::disk('public')->exists($trip_wisata->foto)) {
            Storage::disk('public')->delete($trip_wisata->foto);
        }

        $trip_wisata->foto = $request->file('foto')->store('trip_wisata', 'public');
    }

    $trip_wisata->save();

    return redirect()->route('trip_wisata.index')->with('success', 'Trip berhasil diperbarui');
}

    public function destroy($id_trip_wisata)
    {
        $trip_wisata = TripWisata::where('id_trip_wisata', $id_trip_wisata)->first();

        if (!$trip_wisata) {
            return redirect()->route('trip_wisata.index')->with('error', 'Data trip wisata tidak ditemukan.');
        }

        if ($trip_wisata->foto && Storage::disk('public')->exists($trip_wisata->foto)) {
            Storage::disk('public')->delete($trip_wisata->foto);
        }

        $trip_wisata->delete();

        return redirect()->route('trip_wisata.index')->with('success', 'Data trip wisata berhasil dihapus.');
    }
}
