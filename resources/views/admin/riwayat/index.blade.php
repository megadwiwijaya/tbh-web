@extends('layouts.sidebar')

@section('content')
<div class="container mt-5">
    <h2 class="text-2xl font-bold mb-4">Riwayat Pemesanan</h2>

    {{-- Form Pencarian --}}
    <form action="{{ route('riwayat.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label">Tanggal Awal</label>
            <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
        </div>
        <div class="col-md-3">
            <label class="form-label">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Cari (nama, email, kamar, trip)</label>
            <input type="text" name="search" class="form-control" placeholder="Cari sesuatu..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Cari</button>
        </div>
    </form>

    {{-- Tabs --}}
    <ul class="nav nav-tabs" id="riwayatTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="penginapan-tab" data-bs-toggle="tab" data-bs-target="#penginapan" type="button" role="tab">
                Riwayat Penginapan
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="trip-tab" data-bs-toggle="tab" data-bs-target="#trip" type="button" role="tab">
                Riwayat Trip Wisata
            </button>
        </li>
    </ul>

    <div class="tab-content p-3 border border-top-0" id="riwayatTabsContent">
        {{-- Riwayat Penginapan --}}
        <div class="tab-pane fade show active" id="penginapan" role="tabpanel">
            <h5 class="fw-bold mb-3">Riwayat Pemesanan Penginapan</h5>

            {{-- Tombol Download PDF --}}
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('riwayat.penginapan.pdf', request()->only(['search', 'tanggal_awal', 'tanggal_akhir'])) }}" class="btn btn-danger btn-sm">
                    <i class="bi bi-file-earmark-pdf"></i> Download PDF Penginapan
                </a>
            </div>

            <table class="table table-bordered table-striped text-sm">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No. Telepon</th>
                        <th>Email</th>
                        <th>Tanggal Check In</th>
                        <th>Tanggal Check Out</th>
                        <th>Tipe Kamar</th>
                        <th>Harga</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayatPenginapan as $item)
                        @php
                            $checkin = \Carbon\Carbon::parse($item->tanggal_mulai);
                            $checkout = \Carbon\Carbon::parse($item->tanggal_selesai);
                            $malam = $checkin->diffInDays($checkout);
                            $harga = $item->kamar->harga ?? 0;
                            $total = $malam * $harga;
                        @endphp
                        <tr>
                            <td>{{ $item->user->nama ?? '-' }}</td>
                            <td>{{ $item->user->no_hp ?? '-' }}</td>
                            <td>{{ $item->user->email ?? '-' }}</td>
                            <td>{{ $item->tanggal_mulai }}</td>
                            <td>{{ $item->tanggal_selesai }}</td>
                            <td>{{ $item->kamar->nama_kamar ?? '-' }}</td>
                            <td>Rp{{ number_format($harga, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($total, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($item->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Belum ada riwayat pemesanan penginapan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Riwayat Trip Wisata --}}
        <div class="tab-pane fade" id="trip" role="tabpanel">
            <h5 class="fw-bold mb-3">Riwayat Pemesanan Trip Wisata</h5>

            {{-- Tombol Download PDF --}}
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('riwayat.trip.pdf', request()->only(['search', 'tanggal_awal', 'tanggal_akhir'])) }}" class="btn btn-danger btn-sm">
                    <i class="bi bi-file-earmark-pdf"></i> Download PDF Trip Wisata
                </a>
            </div>

            <table class="table table-bordered table-striped text-sm">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No. Telepon</th>
                        <th>Email</th>
                        <th>Nama Trip</th>
                        <th>Tanggal Trip</th>
                        <th>Hari</th>
                        <th>Jumlah Orang</th>
                        <th>Harga</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayatTrip as $item)
                        @php
                            $start = \Carbon\Carbon::parse($item->tanggal_mulai);
                            $end = \Carbon\Carbon::parse($item->tanggal_selesai);
                            $hari = $start->diffInDays($end);
                            $harga = $item->trip->harga ?? 0;
                            $total = $harga * $item->jumlah_orang;
                        @endphp
                        <tr>
                            <td>{{ $item->user->nama ?? '-' }}</td>
                            <td>{{ $item->user->no_hp ?? '-' }}</td>
                            <td>{{ $item->user->email ?? '-' }}</td>
                            <td>{{ $item->trip->nama_trip ?? '-' }}</td>
                            <td>{{ $item->tanggal_mulai }}</td>
                            <td>{{ $hari }} Hari</td>
                            <td>{{ $item->jumlah_orang }}</td>
                            <td>Rp{{ number_format($harga, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Belum ada riwayat pemesanan trip wisata.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
