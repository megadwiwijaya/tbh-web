@extends('layouts.sidebar')

@section('content')
<div style="padding: 20px;">
    <h2 style="font-size: 30px;">Data Kamar</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('kamar.create') }}" class="btn btn-primary" style="margin-bottom: 16px; font-size: 14px;">+ Tambah Kamar</a>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; table-layout: fixed; font-size: 14px;">
    <thead>
        <tr style="background-color: #f8f9fa;">
            <th style="padding: 10px; border: 1px solid #ddd; width: 120px; white-space: nowrap;">Id Kamar</th>
            <th style="padding: 10px; border: 1px solid #ddd; width: 180px; white-space: nowrap;">Nama Tipe Kamar</th>
            <th style="padding: 10px; border: 1px solid #ddd; width: 160px;">Fasilitas</th>
            <th style="padding: 10px; border: 1px solid #ddd; width: 240px;">Deskripsi</th>
            <th style="padding: 10px; border: 1px solid #ddd; width: 120px;">Harga</th>
            <th style="padding: 10px; border: 1px solid #ddd; width: 160px;">Foto</th>
            <th style="padding: 10px; border: 1px solid #ddd; width: 90px;">Aksi</th>
        </tr>
    </thead>
        <tbody>
            @foreach ($kamars as $kamar)
            <tr>
                {{-- Id Kamar --}}
                <td style="padding: 10px; border: 1px solid #ddd; font-size: 15px; vertical-align: top;">
                    {{ $kamar->id_kamar }}
                </td>

                {{-- Nama Tipe Kamar --}}
                <td style="padding: 10px; border: 1px solid #ddd; font-size: 15px; vertical-align: top;">
                    {{ $kamar->nama_tipe_kamar }}
                </td>

                {{-- Fasilitas --}}
                <td style="padding: 10px; border: 1px solid #ddd; font-size: 15px; vertical-align: top;">
                    {!! nl2br(e($kamar->fasilitas ?? '')) !!}
                </td>

                {{-- Deskripsi --}}
                <td style="padding: 10px; border: 1px solid #ddd; font-size: 15px; vertical-align: top;">
                    <div style="white-space: normal; overflow-wrap: break-word;">
                        {!! nl2br(e($kamar->deskripsi ?? '')) !!}
                    </div>
                </td>

                {{-- Harga --}}
                <td style="padding: 10px; border: 1px solid #ddd; font-size: 15px; vertical-align: top;">
                    Rp {{ number_format($kamar->harga ?? 0, 0, ',', '.') }}
                </td>

                {{-- Foto --}}
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center; vertical-align: top;">
                    @if ($kamar->foto && file_exists(public_path('storage/' . $kamar->foto)))
                        <img src="{{ asset('storage/' . $kamar->foto) }}" alt="Foto" style="max-width: 120px; height: auto; border-radius: 8px;">
                    @else
                        <span>Tidak ada foto</span>
                    @endif
                </td>

                {{-- Aksi --}}
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center; vertical-align: top;">
                    <div style="display: flex; justify-content: center; gap: 6px;">
                        <a href="{{ route('kamar.edit', $kamar->id_kamar) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('kamar.destroy', $kamar->id_kamar) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
