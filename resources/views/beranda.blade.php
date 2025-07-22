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

        .dropdown-button {
            border: 1px solid #000;
            border-radius: 20px;
            padding: 6px 12px;
            background: white;
            cursor: pointer;
            font-size: 14px;
        }

        .slider {
            position: relative;
            width: 100%;
            max-height: 380px;
            overflow: hidden;
        }

        .slides {
            display: flex;
            width: 300%;
            transition: margin-left 0.5s ease-in-out;
        }

        .slides img {
            width: 100vw;
            height: 380pt;
            object-fit: cover;
            flex-shrink: 0;
        }



        .slider-controls {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            padding: 0 20px;
            box-sizing: border-box;
        }

        .slider-controls button {
            background-color: rgba(0,0,0,0.4);
            border: none;
            color: white;
            font-size: 24px;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
            transition: background 0.3s;
        }

        .slider-controls button:hover {
            background-color: rgba(0,0,0,0.6);
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
        <li><a href="{{ route('trip.pelanggan') }}" style="text-decoration: none; color: #333; font-weight: 500;">Trip Wisata</a></li>
        <li><a href="#" style="text-decoration: none; color: #333; font-weight: 500;">Kontak</a></li>
    </ul>
    <div style="display: flex; align-items: center; gap: 16px;">
        <a href="{{ route('pelanggan.profil') }}" style="border: 1px solid #000; border-radius: 20px; padding: 6px 12px; background: white; cursor: pointer; font-size: 14px; text-decoration: none; color: black; display: inline-block;">
            👤 Pengguna
        </a>
</div>
</nav>

<!-- Konten Beranda -->
<section>
    <!-- Banner Slider -->
    <div class="slider" id="slider">
        <div class="slides" id="slide-track">
            <img src="{{ asset('foto/tbh.jpg') }}" alt="Banner 1">
            <img src="{{ asset('foto/tbh1.jpg') }}" alt="Banner 2">
            <img src="{{ asset('foto/tbh.jpg') }}" alt="Banner 3">
        </div>
        <div class="slider-controls">
            <button onclick="moveSlide(-1)">‹</button>
            <button onclick="moveSlide(1)">›</button>
        </div>
    </div>

    <!-- Pencarian -->
<div style="padding: 20px; text-align: center;">
    <h2 style="margin-bottom: 20px;">Cari Kamar atau Trip Wisata</h2>
    <div style="display: flex; justify-content: center; align-items: flex-end; flex-wrap: wrap; gap: 20px;">
        
<!-- Form Cari Tanggal Kamar -->
<form action="{{ route('kamar.pelanggan') }}" method="GET" style="border: 1px solid #007bff; border-radius: 8px; padding: 16px; min-width: 300px; display: flex; flex-direction: column; align-items: center; text-align: center;">
    <p style="font-weight: bold; margin-bottom: 10px;">Cari Tanggal Kamar</p>
    <div style="display: flex; gap: 10px; width: 100%; justify-content: center; align-items: center;">
        <div style="display: flex; flex-direction: column; align-items: center;">
            <label for="checkin" style="font-size: 14px; color: #555;">Check In</label>
            <input type="date" name="checkin" id="checkin" style="padding: 6px 12px; border: 1px solid #ccc; border-radius: 8px; width: 140px; height: 36px;" required>
        </div>
        <div style="display: flex; flex-direction: column; align-items: center;">
            <label for="checkout" style="font-size: 14px; color: #555;">Check Out</label>
            <input type="date" name="checkout" id="checkout" style="padding: 6px 12px; border: 1px solid #ccc; border-radius: 8px; width: 140px; height: 36px;" required>
        </div>
        <button type="submit" style="margin-top: 0; background-color: #007bff; color: white; padding: 6px 16px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; width: 100px; height: 36px; align-self: center;">
            Cari
        </button>
    </div>
</form>

<!-- Form Cari Trip Wisata -->
<form action="{{ route('trip.pelanggan') }}" method="GET" style="border: 1px solid #007bff; border-radius: 8px; padding: 16px; min-width: 300px; display: flex; flex-direction: column; align-items: center; text-align: center;">
    <p style="font-weight: bold; margin-bottom: 10px;">Cari Tanggal Trip Wisata</p>
    <div style="display: flex; gap: 10px; width: 100%; justify-content: center; align-items: center;">
        <div style="display: flex; flex-direction: column; align-items: center;">
            <label for="tanggal" style="font-size: 14px; color: #555;">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="" style="padding: 6px 12px; border: 1px solid #ccc; border-radius: 8px; width: 140px; height: 36px;" required>
        </div>
        <button type="submit" style="margin-top: 0; background-color: #007bff; color: white; padding: 6px 16px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; width: 100px; height: 36px; align-self: center;">
            Cari
        </button>
    </div>
</form>

    <div style="padding: 40px 20px;">
        <h3 style="margin-bottom: 20px;">Trip Wisata</h3>
        <div style="display: flex; gap: 16px; overflow-x: auto;">
            <div style="min-width: 220px; background-color: #f9f9f9; border-radius: 12px; overflow: hidden; box-shadow: 0 0 8px rgba(0,0,0,0.1);">
                <img src="{{ asset('foto/alas pw.jpg') }}" alt="Trip 1" style="width: 100%; height: 120px; object-fit: cover;">
                <div style="padding: 12px;">
                    <strong>Explore Taman Nasional Alas Purwo</strong>
                    <p style="font-size: 12px; color: gray;">1 hari · 3 destinasi</p>
                    <p style="font-weight: bold; color: #007bff;">IDR. 200.000,-</p>
                </div>
            </div>
            <div style="min-width: 220px; background-color: #f9f9f9; border-radius: 12px; overflow: hidden; box-shadow: 0 0 8px rgba(0,0,0,0.1);">
                <img src="{{ asset('foto/baluran.jpg') }}" alt="Trip 2" style="width: 100%; height: 120px; object-fit: cover;">
                <div style="padding: 12px;">
                    <strong>Explore Taman Nasional Baluran</strong>
                    <p style="font-size: 12px; color: gray;">1 hari · 3 destinasi</p>
                    <p style="font-weight: bold; color: #007bff;">IDR. 200.000,-</p>
                </div>
            </div>
            <div style="min-width: 220px; background-color: #f9f9f9; border-radius: 12px; overflow: hidden; box-shadow: 0 0 8px rgba(0,0,0,0.1);">
                <img src="{{ asset('foto/alas pw.jpg') }}" alt="Trip 3" style="width: 100%; height: 120px; object-fit: cover;">
                <div style="padding: 12px;">
                    <strong>Explore Taman Nasional Alas Purwo</strong>
                    <p style="font-size: 12px; color: gray;">1 hari · 3 destinasi</p>
                    <p style="font-weight: bold; color: #007bff;">IDR. 200.000,-</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer style="background-color: #f4f4f4;">
    <div style="padding: 40px 60px 0; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 40px;">
        <div style="flex: 1; min-width: 250px;">
            <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo" style="height: 50px; margin-bottom: 16px;">
            <p style="color: #555; line-height: 1.6;">
                Teluk Biru Homestay merupakan penginapanan yang menawarkan menginap
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

<script>
let index = 0;
const track = document.getElementById('slide-track');
const total = track.children.length;

function moveSlide(step) {
    index = (index + step + total) % total;
    track.style.marginLeft = `-${index * 100}%`;
}

setInterval(() => moveSlide(1), 4000);
</script>

</body>
</html>
