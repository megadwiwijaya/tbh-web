@extends('layouts.sidebar')

@section('content')
<h3>Data Pemesanan</h3>
<table class="table">
    <thead>
        <tr>
            <th>ID Pemesanan</th>
            <th>Nama Pelanggan</th>
            <th>Jenis</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pemesanan as $p)
        <tr>
            <td>{{ $p->id_pemesanan }}</td>
            <td>{{ $p->user->nama }}</td>
            <td>
                @if ($p->kamar)
                    Kamar
                @elseif ($p->tripWisata)
                    Trip Wisata
                @endif
            </td>
            <td>{{ $p->tanggal_mulai }} - {{ $p->tanggal_selesai }}</td>
            <td>
                <form action="{{ route('admin.pemesanan.updateStatus', $p->id_pemesanan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" onchange="this.form.submit()" class="form-select">
                        <option value="berlangsung" {{ $p->status == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="check_in" {{ $p->status == 'check_in' ? 'selected' : '' }}>Check-In</option>
                        <option value="check_out" {{ $p->status == 'check_out' ? 'selected' : '' }}>Check-Out</option>
                        <option value="selesai" {{ $p->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
