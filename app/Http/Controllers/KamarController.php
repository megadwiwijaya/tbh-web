<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::all();
        return view('admin.kamar.index', compact('kamars'));
    }

    public function create()
    {
        return view('admin.kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tipe_kamar' => 'required|string|max:255',
            'fasilitas' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ Generate ID kamar otomatis: KM001, KM002, dst
        $lastKamar = Kamar::orderBy('id_kamar', 'desc')->first();
        if ($lastKamar) {
            $lastNumber = (int) substr($lastKamar->id_kamar, 2);
            $newId = 'KM' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newId = 'KM001';
        }

        // ✅ Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_kamar', 'public');
        }

        // ✅ Simpan data
        Kamar::create([
            'id_kamar' => $newId,
            'nama_tipe_kamar' => $request->nama_tipe_kamar,
            'fasilitas' => $request->fasilitas,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('admin.kamar.edit', compact('kamar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tipe_kamar' => 'required|string|max:255',
            'fasilitas' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $kamar = Kamar::findOrFail($id);
        $kamar->nama_tipe_kamar = $request->nama_tipe_kamar;
        $kamar->fasilitas = $request->fasilitas;
        $kamar->deskripsi = $request->deskripsi;
        $kamar->harga = $request->harga;

        if ($request->hasFile('foto')) {
            if ($kamar->foto && Storage::disk('public')->exists($kamar->foto)) {
                Storage::disk('public')->delete($kamar->foto);
            }

            $fotoPath = $request->file('foto')->store('foto_kamar', 'public');
            $kamar->foto = $fotoPath;
        }

        $kamar->save();

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);

        if ($kamar->foto && Storage::disk('public')->exists($kamar->foto)) {
            Storage::disk('public')->delete($kamar->foto);
        }

        $kamar->delete();

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil dihapus.');
    }
}
