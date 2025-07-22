<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pesan Kamar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .main-content {
            flex: 1;
            padding-top: 70px; /* Increased spacing from navbar */
            padding-bottom: 40px; /* Added bottom padding */
        }
        
        .container-custom {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 0;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            display: flex;
            margin-top: 30px; /* Added top margin for extra space from navbar */
        }
        
        .form-section {
            padding: 50px; /* Increased padding for better spacing */
            border-right: 1px solid #dee2e6;
            flex: 0 0 50%;
        }
        
        .detail-section {
            padding: 50px; /* Increased padding for better spacing */
            flex: 0 0 50%;
        }
        
        label {
            font-weight: 500;
            margin-bottom: 8px; /* Added margin below labels */
        }
        
        .form-control {
            margin-bottom: 20px; /* Added margin below form controls */
        }
        
        .mb-3 {
            margin-bottom: 25px !important; /* Increased form field spacing */
        }
        
        .mb-4 {
            margin-bottom: 35px !important; /* Increased spacing before button */
        }
        
        .datetime-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .datetime-row input {
            flex: 1;
        }
        
        .time-label {
            background-color: #e7f3ff;
            color: #007BFF;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }

        /* Button spacing */
        .btn-primary {
            margin-top: 20px; /* Added top margin to button */
        }

        /* Section headings spacing */
        h3.fw-bold {
            margin-bottom: 30px; /* Added spacing below main heading */
        }

        h5.mt-4 {
            margin-top: 35px !important; /* Increased top margin for section headings */
            margin-bottom: 15px; /* Added bottom margin */
        }

        /* List spacing */
        .list-unstyled {
            margin-bottom: 25px; /* Added margin below facilities list */
        }

        .list-unstyled li {
            margin-bottom: 8px; /* Added spacing between list items */
        }
        
        /* Footer Styles */
        footer {
            background-color: #f4f4f4;
            width: 100%;
            margin-top: auto;
        }
        
        .footer-content {
            padding: 40px 60px 0;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 40px;
            max-width: none;
        }
        
        .footer-section {
            flex: 1;
            min-width: 250px;
        }
        
        .footer-section:nth-child(2) {
            min-width: 150px;
        }
        
        .footer-section:nth-child(3) {
            min-width: 200px;
        }
        
        .footer-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-nav li {
            margin-bottom: 4px;
        }
        
        .footer-nav a {
            text-decoration: none;
            color: black;
        }
        
        .footer-copyright {
            width: 100%;
            text-align: center;
            padding: 16px 0;
            background-color: #1e88e5;
            color: white;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 24px; background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-family: 'Inter', sans-serif; position: fixed; width: 100%; top: 0; z-index: 1000;">
    <div>
        <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo" style="height: 40px;">
    </div>
    <ul style="display: flex; gap: 24px; list-style: none; padding: 0; margin: 0;">
        <li><a href="{{ route('beranda') }}" style="text-decoration: none; color: #333; font-weight: 500;">Beranda</a></li>
        <li><a href="{{ route('tentang.kami') }}" style="text-decoration: none; color: #333; font-weight: 500;">Tentang Kami</a></li>
        <li><a href="{{ route('kamar.pelanggan') }}" class="active" style="text-decoration: none; color: #007BFF;  font-weight: 500;">Kamar</a></li>
        <li><a href="{{ route('trip.pelanggan') }}" style="text-decoration: none; color: #333; font-weight: 500;">Trip Wisata</a></li>
        <li><a href="#" style="text-decoration: none; color: #333; font-weight: 500;">Kontak</a></li>
    </ul>
    <div style="display: flex; align-items: center; gap: 16px;">
        <button style="border: 1px solid #000; border-radius: 20px; padding: 6px 12px; background: white; cursor: pointer; font-size: 14px;">👤 Pengguna</button>
    </div>
</nav>

<!-- Form dan Detail Kamar -->
<div class="main-content">
    <div class="container container-custom">
        <div class="row g-0" style="flex: 1;">

            <!-- Form Pemesanan -->
            <div class="col-md-6 form-section">
                <h2 class="form-title">Form Pesan Trip Kamar</h2>  
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('form.pesan.kamar.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_kamar" value="{{ $kamar->id_kamar }}">

                    <div class="mb-3">
                        <label class="form-label">Check-in</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="date" class="form-control" name="check_in"
                                value="{{ $checkin ?? \Carbon\Carbon::now()->format('Y-m-d') }}"
                                readonly style="background-color: #f8f9fa;">
                            <span style="font-size: 1rem;">14:00</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Check-out</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="date" class="form-control" name="check_out"
                                value="{{ $checkout ?? \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}"
                                readonly style="background-color: #f8f9fa;">
                            <span style="font-size: 1rem;">12:00</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipe Kamar</label>
                        <input type="text" class="form-control" value="{{ $kamar->nama_tipe_kamar }}" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Total Harga</label>
                        <input type="text" class="form-control"
                            value="Rp {{ number_format($kamar->harga * ($checkout && $checkin ? \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout)) : 1), 0, ',', '.') }}" readonly>
                    </div>

                    <button type="submit" name="action" value="pesan" class="btn btn-primary w-50">
                        Pesan Sekarang
                    </button>
                </form>
            </div>

            <!-- Detail Kamar -->
            <div class="col-md-6 detail-section">
                <div style="display: flex; justify-content: center; margin-bottom: 20px;">
                    <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo" style="height: 50px;">
                </div>
                <h3 class="fw-bold">{{ $kamar->nama_tipe_kamar ?? 'Nama Kamar' }}</h3>

                <h6>Fasilitas</h6>
                <div class="mb-4">
                    @foreach (explode("\n", $kamar->fasilitas) as $fasilitas)
                        @if(trim($fasilitas))
                            <div style="display: block; margin-bottom: 10px;">
                                <i class="fa fa-check-circle text-success" style="margin-right: 8px;"></i>
                                <span>{{ trim($fasilitas) }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>

                <h5 class="mb-4">Deskripsi</h5>
                <p>{{ $kamar->deskripsi }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    <div class="footer-content">
        <div class="footer-section">
            <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo" style="height: 50px; margin-bottom: 16px;">
            <p style="color: #555; line-height: 1.6;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            </p>
        </div>
        <div class="footer-section">
            <ul class="footer-nav">
                <li style="font-weight: bold; margin-bottom: 8px;"> </li>
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Kamar</a></li>
                <li><a href="#">Trip Wisata</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        </div>
        <div class="footer-section">
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
    <div class="footer-copyright">
        Copyright © 2025 Teluk Biru Homestay
    </div>
</footer>
</body>
</html>