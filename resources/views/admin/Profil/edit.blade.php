@extends('layouts.sidebar')

@section('content')
<div class="container mt-4">
    <h2>Edit Profil Perusahaan</h2>
    <form action="{{ route('profil.update', $profil->id_profil) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $profil->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Logo Baru (Kosongkan jika tidak diubah)</label>
            <input type="file" name="logo" class="form-control">
            @if ($profil->logo)
                <small>Logo lama: <a href="{{ asset('storage/' . $profil->logo) }}" target="_blank">Lihat</a></small>
            @endif
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required>{{ $profil->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Instagram</label>
            <input type="text" name="instagram" class="form-control" value="{{ $profil->instagram }}">
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $profil->no_hp }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $profil->email }}">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('profil.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
