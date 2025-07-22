<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Trip Wisata</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 24px; background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-family: 'Inter', sans-serif;">
    <div>
        <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo" style="height: 40px;">
    </div>
    <ul style="display: flex; gap: 24px; list-style: none; padding: 0; margin: 0;">
        <li><a href="{{ route('beranda') }}" class="active" style="text-decoration: none; color: #007BFF; font-weight: 500;">Beranda</a></li>
        <li><a href="{{ route('tentang.kami') }}" style="text-decoration: none; color: #333; font-weight: 500;">Tentang Kami</a></li>
        <li><a href="{{ route('kamar.pelanggan') }}" style="text-decoration: none; color: #333; font-weight: 500;">Kamar</a></li>
        <li><a href="#" style="text-decoration: none; color: #333; font-weight: 500;">Trip Wisata</a></li>
        <li><a href="#" style="text-decoration: none; color: #333; font-weight: 500;">Kontak</a></li>
    </ul>
    <div style="display: flex; align-items: center; gap: 16px;">
        <button style="border: 1px solid #000; border-radius: 20px; padding: 6px 12px; background: white; cursor: pointer; font-size: 14px;">👤 Pengguna</button>
    </div>
</nav>

<div class="container" style="padding: 20px; font-family: 'Inter', sans-serif;">
    <h2 style="text-align: center; margin-bottom: 20px;">Trip Wisata</h2>

    @if (!empty($tanggal))
        <p style="text-align: center; color: #555; font-size: 14px; margin-bottom: 30px;">
            Trip wisata yang tersedia pada tanggal:
            <span style="font-weight: bold;">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</span>
        </p>
    @endif

    <!-- Daftar Trip -->
    <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
        @forelse ($trips as $trip)
            <div style="width: 300px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <img src="{{ asset('storage/' . $trip->foto) }}" alt="{{ $trip->nama_trip }}" style="width: 100%; height: 180px; object-fit: cover;">
                <div style="padding: 16px;">
                    <strong style="display: block; font-size: 16px; margin-bottom: 6px;">{{ $trip->nama_trip }}</strong>
                    <p style="font-size: 14px; color: gray; margin-bottom: 6px;">{{ $trip->lokasi }}</p>
                    <p style="font-weight: bold; color: #007bff; margin-bottom: 8px;">Rp {{ number_format($trip->harga, 0, ',', '.') }}</p>

                    <!-- Tombol Detail -->
                    <a href="{{ route('trip.detail', ['id' => $trip->id_trip_wisata, 'tanggal' => request('tanggal')]) }}" style="text-decoration: none;">
                        <button type="button"
                                style="background-color: #007bff; color: white; border: none; border-radius: 8px; padding: 6px 12px; cursor: pointer; font-family: 'Inter', sans-serif !important; font-size: 13px !important; font-weight: 500 !important; width: 100px; height: 36px;">
                            Lihat Detail
                        </button>
                    </a>
                </div>
            </div>
        @empty
            <p style="text-align: center; color: #888;">Tidak ada trip wisata tersedia.</p>
        @endforelse
    </div>
</div>

<!-- Footer -->
<footer style="background-color: #f4f4f4;">
    <div style="padding: 40px 60px 0; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 40px;">
        <div style="flex: 1; min-width: 250px;">
            <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo" style="height: 50px; margin-bottom: 16px;">
            <p style="color: #555; line-height: 1.6;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            </p>
        </div>
        <div style="flex: 1; min-width: 150px;">
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="font-weight: bold; margin-bottom: 8px;">&nbsp;</li>
                <li><a href="#" style="text-decoration: none; color: black;">Beranda</a></li>
                <li><a href="#" style="text-decoration: none; color: black;">Tentang Kami</a></li>
                <li><a href="#" style="text-decoration: none; color: black;">Kamar</a></li>
                <li><a href="#" style="text-decoration: none; color: black;">Trip Wisata</a></li>
                <li><a href="#" style="text-decoration: none; color: black;">Kontak</a></li>
            </ul>
        </div>
        <div style="flex: 1; min-width: 200px;">
            <p style="font-weight: bold; margin-bottom: 8px;">Kontak Kami</p>
            <p style="color: #555; margin: 4px 0;">
                <i class="fas fa-envelope" style="margin-right: 8px;"></i>biruhomestay@mail.com
            </p>
            <p style="color: #555; margin: 4px 0;">
                <i class="fab fa-instagram" style="margin-right: 8px;"></i>villatelukbiru
            </p>
            <p style="color: #555; margin: 4px 0;">
                <i class="fab fa-whatsapp" style="margin-right: 8px;"></i>0812-3456-7891
            </p>
        </div>
    </div>
    <div style="width: 100%; text-align: center; padding: 16px 0; background-color: #1e88e5; color: white; margin-top: 40px;">
        Copyright © 2025 Teluk Biru Homestay
    </div>
</footer>
</body>
</html>