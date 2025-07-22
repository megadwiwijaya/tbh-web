@extends('layouts.sidebar')

@section('content')
<div class="container mt-4" style="background-color: #f2f5f8; padding: 30px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05); max-width: 800px;">
    <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 25px;">Edit Data Kamar</h2>

    @if ($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kamar.update', $kamar->id_kamar) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Tipe Kamar</label>
            <input type="text" name="nama_tipe_kamar" value="{{ old('nama_tipe_kamar', $kamar->nama_tipe_kamar) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fasilitas</label>
            <textarea name="fasilitas" class="form-control" rows="3" required>{{ old('fasilitas', $kamar->fasilitas) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" value="{{ old('harga', $kamar->harga) }}" class="form-control" required>
        </div>

            @if ($kamar->foto)
                <div class="mb-3">
                    <label class="form-label">Foto Saat Ini</label><br>
                    <img src="{{ asset('storage/' . $kamar->foto) }}" alt="Foto Kamar" style="max-height: 200px; border-radius: 8px; border: 1px solid #ccc; margin-top: 8px;">
                </div>
            @endif

        <div class="d-flex justify-content-start gap-2 mt-4">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('kamar.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
     @endsection
