@extends('layouts.sidebar')

@section('content')
<div class="container mt-4">
    <h2>Data Profil Perusahaan</h2>
    <a href="{{ route('profil.create') }}" class="btn btn-success mb-3">+ Tambah Profil</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Logo</th>
                <th>Deskripsi</th>
                <th>Instagram</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profil as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>
                        @if ($item->logo)
                            <img src="{{ asset('storage/' . $item->logo) }}" width="80">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 50) }}</td>
                    <td>{{ $item->instagram }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <a href="{{ route('profil.edit', $item->id_profil) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('profil.destroy', $item->id_profil) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
