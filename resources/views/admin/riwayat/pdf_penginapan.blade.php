<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Riwayat Penginapan</title>
    <style>
        *      { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h3     { margin: 0 0 8px 0; }
        table  { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000;  /* hitam eksplisit */
                 padding: 4px; text-align: left; }
        th     { background: #f0f0f0; }
    </style>
</head>
<body>
    <h3>Riwayat Pemesanan Penginapan</h3>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>No. Telepon</th>
                <th>Email</th>
                <th>Check‑In</th>
                <th>Check‑Out</th>
                <th>Tipe Kamar</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($riwayatPenginapan as $item)
            @php
                $checkin  = \Carbon\Carbon::parse($item->tanggal_mulai);
                $checkout = \Carbon\Carbon::parse($item->tanggal_selesai);
                $malam    = $checkin->diffInDays($checkout);
                $harga    = $item->kamar->harga ?? 0;
                $total    = $malam * $harga;
            @endphp
            <tr>
                <td>{{ $item->user->nama ?? '-' }}</td>
                <td>{{ $item->user->no_hp ?? '-' }}</td>
                <td>{{ $item->user->email ?? '-' }}</td>
                <td>{{ $item->tanggal_mulai }}</td>
                <td>{{ $item->tanggal_selesai }}</td>
                <td>{{ $item->kamar->nama_kamar ?? '-' }}</td>
                <td>Rp{{ number_format($harga,0,',','.') }}</td>
                <td>Rp{{ number_format($total,0,',','.') }}</td>
                <td>{{ ucfirst($item->status) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
