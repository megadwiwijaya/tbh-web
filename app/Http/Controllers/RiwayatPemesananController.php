<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatPemesananController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $riwayatPenginapan = Pemesanan::with(['user', 'kamar'])
            ->whereNotNull('id_kamar')
            ->whereNotNull('status')
            ->when($tanggalAwal && $tanggalAkhir, fn($q) => $q->whereBetween('tanggal_mulai', [$tanggalAwal, $tanggalAkhir]))
            ->when($search, function ($q) use ($search) {
                $q->whereHas('user', fn($q) => $q->where('nama', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('no_hp', 'like', "%$search%"))
                    ->orWhereHas('kamar', fn($q) => $q->where('nama_kamar', 'like', "%$search%"));
            })
            ->get();

        $riwayatTrip = Pemesanan::with(['user', 'trip'])
            ->whereNotNull('id_trip_wisata')
            ->whereNotNull('status')
            ->when($tanggalAwal && $tanggalAkhir, fn($q) => $q->whereBetween('tanggal_mulai', [$tanggalAwal, $tanggalAkhir]))
            ->when($search, function ($q) use ($search) {
                $q->whereHas('user', fn($q) => $q->where('nama', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('no_hp', 'like', "%$search%"))
                    ->orWhereHas('trip', fn($q) => $q->where('nama_trip', 'like', "%$search%"));
            })
            ->get();

        return view('admin.riwayat.index', compact('riwayatPenginapan', 'riwayatTrip', 'search', 'tanggalAwal', 'tanggalAkhir'));
    }

    public function exportPenginapan(Request $request)
    {
        $search = $request->input('search');
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $riwayatPenginapan = Pemesanan::with(['user', 'kamar'])
            ->whereNotNull('id_kamar')
            ->whereNotNull('status')
            ->when($tanggalAwal && $tanggalAkhir, fn($q) => $q->whereBetween('tanggal_mulai', [$tanggalAwal, $tanggalAkhir]))
            ->when($search, function ($q) use ($search) {
                $q->whereHas('user', fn($q) => $q->where('nama', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('no_hp', 'like', "%$search%"))
                    ->orWhereHas('kamar', fn($q) => $q->where('nama_kamar', 'like', "%$search%"));
            })
            ->get();

        $pdf = Pdf::loadView('admin.riwayat.pdf_penginapan', compact('riwayatPenginapan'));
        return $pdf->download('riwayat_penginapan.pdf');
    }

    public function exportTrip(Request $request)
    {
        $search = $request->input('search');
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $riwayatTrip = Pemesanan::with(['user', 'trip'])
            ->whereNotNull('id_trip_wisata')
            ->whereNotNull('status')
            ->when($tanggalAwal && $tanggalAkhir, fn($q) => $q->whereBetween('tanggal_mulai', [$tanggalAwal, $tanggalAkhir]))
            ->when($search, function ($q) use ($search) {
                $q->whereHas('user', fn($q) => $q->where('nama', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('no_hp', 'like', "%$search%"))
                    ->orWhereHas('trip', fn($q) => $q->where('nama_trip', 'like', "%$search%"));
            })
            ->get();

        $pdf = Pdf::loadView('admin.riwayat.pdf_trip', compact('riwayatTrip'));
        return $pdf->download('riwayat_trip.pdf');
    }
}
