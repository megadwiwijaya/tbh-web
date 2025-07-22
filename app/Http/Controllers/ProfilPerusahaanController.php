<?php

namespace App\Http\Controllers;

use App\Models\ProfilPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilPerusahaanController extends Controller
{
    public function index()
    {
        $profil = ProfilPerusahaan::all();
        return view('admin.profil.index', compact('profil'));
    }

    public function create()
    {
        return view('admin.profil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'instagram' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $last = ProfilPerusahaan::orderBy('id_profil', 'desc')->first();
        $newId = $last ? 'PP' . str_pad((int)substr($last->id_profil, 2) + 1, 3, '0', STR_PAD_LEFT) : 'PP001';

        $logoPath = $request->hasFile('logo')
            ? $request->file('logo')->store('logo_perusahaan', 'public')
            : null;

        ProfilPerusahaan::create([
            'id_profil' => $newId,
            'nama' => $request->nama,
            'logo' => $logoPath,
            'deskripsi' => $request->deskripsi,
            'instagram' => $request->instagram,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        return redirect()->route('profil.index')->with('success', 'Profil perusahaan berhasil disimpan.');
    }

    public function edit($id)
    {
        $profil = ProfilPerusahaan::findOrFail($id);
        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        $profil = ProfilPerusahaan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required',
            'instagram' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        if ($request->hasFile('logo')) {
            if ($profil->logo) Storage::disk('public')->delete($profil->logo);
            $profil->logo = $request->file('logo')->store('logo_perusahaan', 'public');
        }

        $profil->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'instagram' => $request->instagram,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'logo' => $profil->logo,
        ]);

        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $profil = ProfilPerusahaan::findOrFail($id);
        if ($profil->logo) Storage::disk('public')->delete($profil->logo);
        $profil->delete();

        return redirect()->route('profil.index')->with('success', 'Profil berhasil dihapus.');
    }
}
