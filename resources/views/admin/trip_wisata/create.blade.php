@extends('layouts.sidebar')

@section('title', 'Tambah Trip Wisata')

@section('content')
<div class="container mt-4" style="background-color: #f2f5f8; padding: 30px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05); max-width: 800px;">
    <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 25px;">Tambah Trip Wisata</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('trip_wisata.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama_trip" class="form-label">Nama Trip</label>
            <input type="text" name="nama_trip" id="nama_trip" class="form-control @error('nama_trip') is-invalid @enderror" value="{{ old('nama_trip') }}">
            @error('nama_trip')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="destinasi" class="form-label">Destinasi</label>
            <textarea name="destinasi" id="destinasi" class="form-control" rows="3">{{ old('destinasi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="fasilitas" class="form-label">Fasilitas</label>
            <textarea name="fasilitas" id="fasilitas" class="form-control" rows="3">{{ old('fasilitas') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}">
            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Upload Foto</label>
            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-start gap-2 mt-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('trip_wisata.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
