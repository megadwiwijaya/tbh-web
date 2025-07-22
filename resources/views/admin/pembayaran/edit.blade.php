@extends('layouts.sidebar')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Pembayaran</h2>

    <form action="{{ route('pembayaran.update', $pembayaran->id_pembayaran) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Pemesanan</label>
            <input type="text" class="form-control" disabled
                value="{{ $pembayaran->pemesanan->user->nama ?? '-' }} - 
                       {{ $pembayaran->pemesanan->id_kamar ? ($pembayaran->pemesanan->kamar->nama_kamar ?? '-') : ($pembayaran->pemesanan->trip->nama_trip ?? '-') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <input type="text" class="form-control" disabled value="{{ $pembayaran->keterangan }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending" {{ $pembayaran->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="setuju" {{ $pembayaran->status == 'setuju' ? 'selected' : '' }}>Setuju</option>
                <option value="ditolak" {{ $pembayaran->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
