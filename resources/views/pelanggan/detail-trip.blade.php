<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Trip Wisata</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
        }
        footer, footer div {
            box-sizing: border-box;
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

<div class="container py-5">
    {{-- Bagian Atas: Gambar & Detail --}}
    <div class="row">
        <!-- Kolom Gambar -->
        <div class="col-md-6">
            <!-- Gambar Utama -->
            <img src="{{ asset('storage/' . $trip_wisata->foto) }}" class="img-fluid rounded mb-3" alt="Foto Trip">

            <!-- Gambar Thumbnail (pakai ulang gambar utama untuk placeholder) -->
            <div class="d-flex gap-2 mb-4">
                @for ($i = 0; $i < 3; $i++)
                    <img src="{{ asset('storage/' . $trip_wisata->foto) }}" class="img-thumbnail" style="width: 140px; height: 100px; object-fit: cover;" alt="Thumbnail Trip">
                @endfor
            </div>
        </div>

        <!-- Kolom Teks -->
        <div class="col-md-6">
            <h3><strong>{{ $trip_wisata->nama_trip ?? 'Nama Trip' }}</strong></h3>

            {{-- Destinasi --}}
            <h5 class="mt-3">Destinasi</h5>
            <ul class="list-unstyled">
                @foreach (explode(',', $trip_wisata->destinasi) as $item)
                    <li>{{ trim($item) }}</li>
                @endforeach
            </ul>

            {{-- Harga --}}
            <h4 class="mt-4 text-primary">IDR {{ number_format($trip_wisata->harga, 0, ',', '.') }},-</h4>
            <a href="{{ route('form.pesan.trip', ['id' => $trip_wisata->id_trip_wisata, 'tanggal' => request('tanggal')]) }}" class="btn btn-primary">
                Pesan Sekarang
            </a>
        </div>
    </div>
</div>

<!-- Footer -->
<footer style="background-color: #f4f4f4; width: 100%; margin-top: 60px;">
    <div style="width: 100%; padding: 48px 24px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 40px; max-width: none;">
        <div style="flex: 1; min-width: 250px; margin-left: 10%;">
            <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo" style="height: 50px; margin-bottom: 16px;">
            <p style="color: #555; line-height: 1.6;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            </p>
        </div>
        <div style="flex: 1; min-width: 150px;">
            <p style="font-weight: bold; margin-bottom: 8px;">Navigasi</p>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li><a href="{{ route('beranda') }}" style="text-decoration: none; color: black;">Beranda</a></li>
                <li><a href="{{ route('tentang.kami') }}" style="text-decoration: none; color: black;">Tentang Kami</a></li>
                <li><a href="{{ route('kamar.pelanggan') }}" style="text-decoration: none; color: black;">Kamar</a></li>
                <li><a href="#" style="text-decoration: none; color: black;">Trip Wisata</a></li>
                <li><a href="#" style="text-decoration: none; color: black;">Kontak</a></li>
            </ul>
        </div>
        <div style="flex: 1; min-width: 200px; margin-right: 10%;">
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
    <div style="width: 100%; text-align: center; padding: 16px 0; background-color: #1e88e5; color: white;">
        Copyright © 2025 Teluk Biru Homestay
    </div>
</footer>
</body>
</html>