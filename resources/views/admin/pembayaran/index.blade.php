@extends('layouts.sidebar')

@section('content')
<h3>Data Pembayaran</h3>
<table class="table">
    <thead>
        <tr>
            <th>ID Pembayaran</th>
            <th>Nama Pelanggan</th>
            <th>ID Pemesanan</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Total Bayar</th>
            <th>Sisa Tagihan</th>
            <th>Bukti</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pembayaran as $p)
        <tr>
            <td>{{ $p->id_pembayaran }}</td>
            <td>{{ $p->pemesanan->user->nama ?? '-' }}</td>
            <td>{{ $p->id_pemesanan }}</td>
            <td>{{ $p->keterangan }}</td>
            <td>
                <form action="{{ route('admin.pembayaran.updateStatus', $p->id_pembayaran) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" onchange="this.form.submit()" class="form-select">
                        <option value="pending" {{ $p->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="setuju" {{ $p->status == 'setuju' ? 'selected' : '' }}>Setuju</option>
                        <option value="ditolak" {{ $p->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </form>
            </td>
            <td>Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($p->sisa_tagihan, 0, ',', '.') }}</td>
            <td>
                @if ($p->bukti)
                    <a href="{{ asset('storage/bukti/' . $p->bukti) }}" target="_blank">Lihat</a>
                @else
                    -
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
