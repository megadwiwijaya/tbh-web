@extends('layouts.sidebar')

@section('content')
<div class="container mt-4">
    <h2>Tambah Profil Perusahaan</h2>
    <form action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label>Instagram</label>
            <input type="text" name="instagram" class="form-control">
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('profil.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
