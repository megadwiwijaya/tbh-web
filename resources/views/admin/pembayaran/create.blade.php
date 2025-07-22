@extends('layouts.sidebar')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Pembayaran</h2>

    <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="id_pemesanan" class="form-label">Pilih Pemesanan</label>
            <select name="id_pemesanan" class="form-control" required>
                <option value="">-- Pilih Pemesanan --</option>
                @foreach ($pemesanan as $item)
                    @php
                        $nama = $item->user->nama ?? '-';
                        $layanan = $item->id_kamar ? 'Penginapan: ' . ($item->kamar->nama_kamar ?? '-') : 'Trip: ' . ($item->trip->nama_trip ?? '-');
                    @endphp
                    <option value="{{ $item->id_pemesanan }}">{{ $nama }} - {{ $layanan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="bukti" class="form-label">Upload Bukti</label>
            <input type="file" name="bukti" class="form-control" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <select name="keterangan" class="form-control" required>
                <option value="DP">DP</option>
                <option value="Lunas">Lunas</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="setuju">Setuju</option>
                <option value="ditolak">Ditolak</option>
            </select>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
