<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Riwayat Trip Wisata</title>
    <style>
        *      { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h3     { margin: 0 0 8px 0; }
        table  { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
        th     { background: #f0f0f0; }
    </style>
</head>
<body>
    <h3>Riwayat Pemesanan Trip Wisata</h3>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>No. Telepon</th>
                <th>Email</th>
                <th>Nama Trip</th>
                <th>Tanggal Trip</th>
                <th>Hari</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($riwayatTrip as $item)
            @php
                $start  = \Carbon\Carbon::parse($item->tanggal_mulai);
                $end    = \Carbon\Carbon::parse($item->tanggal_selesai);
                $hari   = $start->diffInDays($end);
                $harga  = $item->trip->harga ?? 0;
                $total  = $harga * $item->jumlah_orang;
            @endphp
            <tr>
                <td>{{ $item->user->nama ?? '-' }}</td>
                <td>{{ $item->user->no_hp ?? '-' }}</td>
                <td>{{ $item->user->email ?? '-' }}</td>
                <td>{{ $item->trip->nama_trip ?? '-' }}</td>
                <td>{{ $item->tanggal_mulai }}</td>
                <td>{{ $hari }} Hari</td>
                <td>{{ $item->jumlah_orang }}</td>
                <td>Rp{{ number_format($harga,0,',','.') }}</td>
                <td>Rp{{ number_format($total,0,',','.') }}</td>
                <td>{{ ucfirst($item->status) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
