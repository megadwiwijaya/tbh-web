<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 24px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar img {
            height: 40px;
        }

        .nav-menu {
            display: flex;
            gap: 24px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-menu a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        .nav-menu a.active {
            color: #007BFF;
        }

        .nav-menu a:hover {
            color: #007BFF;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
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
        <li><a href="{{ route('beranda') }}" style="text-decoration: none; color: #333; font-weight: 500;">Beranda</a></li>
        <li><a href="{{ route('tentang.kami') }}" class="active" style="text-decoration: none; color: #007BFF; font-weight: 500;">Tentang Kami</a></li>
        <li><a href="{{ route('kamar.pelanggan') }}" style="text-decoration: none; color: #333; font-weight: 500;">Kamar</a></li>
        <li><a href="#" style="text-decoration: none; color: #333; font-weight: 500;">Trip Wisata</a></li>
        <li><a href="#" style="text-decoration: none; color: #333; font-weight: 500;">Kontak</a></li>
    </ul>
    <div style="display: flex; align-items: center; gap: 16px;">
        <button style="border: 1px solid #000; border-radius: 20px; padding: 6px 12px; background: white; cursor: pointer; font-size: 14px;">👤 Pengguna</button>
    </div>
</nav>
    <!-- Tentang Kami -->
    <section>
    <!-- Judul -->
    <div style="background-color: #1e88e5; padding: 20px 0; text-align: center; color: white;">
        <h2 style="margin: 0;">Tentang Kami</h2>
    </div>

    <!-- Konten -->
    <div style="max-width: 800px; margin: 40px auto; padding: 0 20px; text-align: center;">

        <!-- Gambar -->
        <img src="{{ asset('foto/tbh.jpg') }}" alt="Kamar Homestay" 
             style="width: 100%; max-width: 400px; border-radius: 12px; margin-bottom: 24px;">

        <!-- Deskripsi -->
        <p style="text-align: justify; color: #333; line-height: 1.6;">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
            It has survived not only five centuries, but also the leap into electronic typesetting, 
            remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset 
            sheets containing Lorem Ipsum passages.
        </p>

        <p style="text-align: justify; color: #333; line-height: 1.6;">
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration 
            in some form, by injected humour, or randomised words which don't look even slightly believable.
        </p>
    </div>
</section>

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