@extends('layouts.sidebar')

@section('content')
<style>
    .container {
        padding: 16px 24px;
    }

    h2 {
        margin-bottom: 16px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
    }

    th, td {
        padding: 10px 14px;
        text-align: left;
        vertical-align: top;
        border: 1px solid #ddd;
        font-size: 15px;
    }

    thead th {
        background-color: #f8f9fa;
        font-weight: 600;
        white-space: nowrap;
        min-width: 140px;
    }

    td img {
        max-width: 120px;
        height: auto;
        display: block;
        margin: 0 auto;
        border-radius: 8px;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 0.875rem;
    }

    .description-column {
        white-space: normal;
        word-wrap: break-word;
        max-width: 280px;
    }

    .table-responsive {
        /* Default (desktop) — tidak pakai scroll */
        overflow-x: unset;
    }

    .btn-tambah {
        margin-bottom: 16px;
    }

    @media (max-width: 768px) {
        th, td {
            font-size: 14px;
            padding: 10px;
        }

        td img {
            max-width: 90px;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }
</style>

<div class="container mt-2"> {{-- dikurangi dari mt-4 jadi mt-2 biar tidak terlalu jauh --}}
    <h2>Data Trip Wisata</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('trip_wisata.create') }}" class="btn btn-primary btn-tambah">+ Tambah Trip Wisata</a>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Id Trip Wisata</th>
                    <th>Nama Trip</th>
                    <th>Destinasi</th>
                    <th>Fasilitas</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($trips as $trip)
            <tr>
            <td>{{ $trip->id_trip_wisata }}</td>
            <td>{{ $trip->nama_trip }}</td>
            <td>{!! nl2br(e($trip->destinasi)) !!}</td>
            <td class="facility-column">{!! nl2br(e($trip->fasilitas)) !!}</td>
            <td>Rp {{ number_format($trip->harga, 0, ',', '.') }}</td>
            <td>
        @if ($trip->foto)
            <img src="{{ asset('storage/' . $trip->foto) }}" alt="Foto Trip Wisata">
        @endif
    </td>
            {{-- Aksi dengan icon --}}
        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
            <a href="{{ route('trip_wisata.edit', $trip->id_trip_wisata) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                <i class="bi bi-pencil-square"></i>
            </a>
            <form action="{{ route('trip_wisata.destroy', $trip->id_trip_wisata) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </td>
    </tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
