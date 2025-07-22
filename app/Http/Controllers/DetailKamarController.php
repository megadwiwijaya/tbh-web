<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class DetailKamarController extends Controller
{
    /**
     * Menampilkan detail dari kamar berdasarkan ID.
     */
    public function show($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('pelanggan.detail-kamar', compact('kamar'));
    }
}
