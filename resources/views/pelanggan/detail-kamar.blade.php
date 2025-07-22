<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Kamar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <li><a href="{{ route('beranda') }}" style="text-decoration: none; color: #007BFF; font-weight: 500;">Beranda</a></li>
        <li><a href="{{ route('tentang.kami') }}" style="text-decoration: none; color: #333; font-weight: 500;">Tentang Kami</a></li>
        <li><a href="{{ route('kamar.pelanggan') }}" class="active" style="text-decoration: none; color: #333; font-weight: 500;">Kamar</a></li>
        <li><a href="{{ route('trip.pelanggan') }}" style="text-decoration: none; color: #333; font-weight: 500;">Trip Wisata</a></li>
        <li><a href="#" style="text-decoration: none; color: #333; font-weight: 500;">Kontak</a></li>
    </ul>
    <div style="display: flex; align-items: center; gap: 16px;">
        <button style="border: 1px solid #000; border-radius: 20px; padding: 6px 12px; background: white; cursor: pointer; font-size: 14px;">👤 Pengguna</button>
    </div>
</nav>

        <div class="container py-5">
            <div class="row">
                <div class="col-md-6">
            <!-- Gambar Utama -->
            <img src="{{ asset('storage/' . $kamar->foto) }}" class="img-fluid rounded mb-3" alt="Foto Kamar">

            <!-- Gambar Thumbnail (pakai ulang gambar utama untuk placeholder) -->
            <div class="d-flex gap-2 mb-4">
                @for ($i = 0; $i < 3; $i++)
                    <img src="{{ asset('storage/' . $kamar->foto) }}" class="img-thumbnail" style="width: 140px; height: 100px; object-fit: cover;" alt="Thumbnail Kamar">
                @endfor
            </div>
        </div>

        <!-- ✅ KOLOM TEKS KANAN -->
        <div class="col-md-6">
            <h3><strong>{{ $kamar->nama_tipe_kamar ?? 'Nama Kamar' }}</strong></h3>

            <h5 class="mt-3 fw-bold">Fasilitas</h5>
            <ul class="list-unstyled">
                @foreach (explode(',', $kamar->fasilitas) as $item)
                    <li>{{ trim($item) }}</li>
                @endforeach
            </ul>

            <h5 class="mt-4 fw-bold">Deskripsi</h5>
            <p>{{ $kamar->deskripsi }}</p>

            <h4 class="mt-4 text-primary">IDR {{ number_format($kamar->harga, 0, ',', '.') }},-</h4>
            <a href="{{ route('form.pesan.kamar', [
                'id' => $kamar->id_kamar,
                'checkin' => request('checkin') ?? old('checkin'),
                'checkout' => request('checkout') ?? old('checkout')
            ]) }}" class="btn btn-primary">
                Pesan Sekarang
            </a>
        </div>
    </div>

    <!-- ✅ Testimoni Carousel -->
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Tourist Talk’s About Us</h4>
            <div class="d-flex align-items-center gap-2">
                <span class="fw-bold fs-5">4.9/5</span>
                <div class="text-warning">
                    ⭐⭐⭐⭐⭐
                </div>
                <button class="btn btn-light btn-sm"><i class="fas fa-chevron-left"></i></button>
                <button class="btn btn-light btn-sm"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>

        <div class="d-flex overflow-auto pb-2" style="scroll-snap-type: x mandatory;">
            <!-- Testimoni 1 -->
            <div class="card me-3 p-3 shadow-sm" style="min-width: 300px; scroll-snap-align: start;">
                <div class="d-flex align-items-center mb-2">
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar">
                    <div>
                        <strong>John Doe</strong><br>
                        <small class="text-muted">Solo, Jawa Tengah</small>
                    </div>
                </div>
                <p class="mb-2 fst-italic" style="font-size: 14px;">
                    Sangat nyaman dan bersih! Tempat tidurnya empuk, AC dingin, dan suasana kamar sangat tenang. Cocok untuk liburan bersama teman. Pelayanannya juga ramah dan responsif.
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-warning">⭐⭐⭐⭐⭐</span>
                    <span class="badge bg-primary text-white">28 Mei 2024</span>
                </div>
            </div>

            <!-- Testimoni 2 -->
            <div class="card me-3 p-3 shadow-sm" style="min-width: 300px; scroll-snap-align: start;">
                <div class="d-flex align-items-center mb-2">
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar">
                    <div>
                        <strong>Farahzia</strong><br>
                        <small class="text-muted">Bandung, Jawa Barat</small>
                    </div>
                </div>
                <p class="mb-2 fst-italic" style="font-size: 14px;">
                    Pilihan terbaik untuk staycation! Twin Bed Room ini sangat nyaman untuk saya dan sahabat saya. Lokasi strategis, dekat tempat makan dan pusat belanja. Recommended!
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-warning">⭐⭐⭐⭐⭐</span>
                    <span class="badge bg-primary text-white">28 Mei 2024</span>
                </div>
            </div>

            <!-- Testimoni 3 -->
            <div class="card me-3 p-3 shadow-sm" style="min-width: 300px; scroll-snap-align: start;">
                <div class="d-flex align-items-center mb-2">
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="avatar">
                    <div>
                        <strong>Yusuf</strong><br>
                        <small class="text-muted">Surabaya, Jawa Timur</small>
                    </div>
                </div>
                <p class="mb-2 fst-italic" style="font-size: 14px;">
                    Kamarnya luas, staf ramah, dan lokasi dekat pantai. Cocok untuk liburan keluarga. Pasti balik lagi!
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-warning">⭐⭐⭐⭐</span>
                    <span class="badge bg-primary text-white">15 Mei 2024</span>
                </div>
            </div>
        </div>

        <!-- Pagination Dot -->
        <div class="d-flex justify-content-center mt-3 gap-2">
            <div style="width: 30px; height: 8px; background-color: #1e88e5; border-radius: 20px;"></div>
            <div style="width: 8px; height: 8px; background-color: #ccc; border-radius: 50%;"></div>
            <div style="width: 8px; height: 8px; background-color: #ccc; border-radius: 50%;"></div>
            <div style="width: 8px; height: 8px; background-color: #ccc; border-radius: 50%;"></div>
        </div>
    </div>
</div>


<!-- Footer -->
<footer style="background-color: #f4f4f4;">
    <div style="padding: 40px 60px 0; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 40px;">
        <div style="flex: 1; min-width: 250px;">
            <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo" style="height: 50px; margin-bottom: 16px;">
            <p style="color: #555; line-height: 1.6;">
                Teluk Biru Homestay merupakan penginapan yang menawarkan menginap
                dengan suasana pedesaan yang asri dan nyaman.
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