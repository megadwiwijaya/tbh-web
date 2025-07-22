<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pesan Trip</title>
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
            padding-top: 100px;
            padding-bottom: 40px;
        }
        
        .container-custom {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 0;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            display: flex;
            margin-top: 30px;
        }
        
        .form-section {
            padding: 50px;
            border-right: 1px solid #dee2e6;
            flex: 0 0 50%;
        }
        
        .detail-section {
            padding: 50px;
            flex: 0 0 50%;
        }
        
        label {
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .form-control {
            margin-bottom: 20px;
        }
        
        .mb-3 {
            margin-bottom: 25px !important;
        }
        
        .mb-4 {
            margin-bottom: 35px !important;
        }

        .btn-primary {
            margin-top: 10px;
        }

        h3.fw-bold {
            margin-bottom: 30px;
        }

        h5.mt-4 {
            margin-top: 35px !important;
            margin-bottom: 15px;
        }

        h6 {
            margin-bottom: 15px;
            font-weight: 600;
        }

        .list-unstyled {
            margin-bottom: 25px;
        }

        .list-unstyled li {
            margin-bottom: 8px;
        }

        .fasilitas-item, .destinasi-item {
            display: block;
            margin-bottom: 12px;
            line-height: 1.4;
        }
        
        .fasilitas-item i, .destinasi-item i {
            margin-right: 8px;
            color: #28a745;
        }

        .bg-light-custom {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        
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
        <li><a href="{{ route('kamar.pelanggan') }}" style="text-decoration: none; color: #333; font-weight: 500;">Kamar</a></li>
        <li><a href="{{ route('trip.pelanggan') }}" class="active" style="text-decoration: none; color: #007BFF; font-weight: 500;">Trip Wisata</a></li>
        <li><a href="#" style="text-decoration: none; color: #333; font-weight: 500;">Kontak</a></li>
    </ul>
    <div style="display: flex; align-items: center; gap: 16px;">
        <button style="border: 1px solid #000; border-radius: 20px; padding: 6px 12px; background: white; cursor: pointer; font-size: 14px;">👤 Pengguna</button>
    </div>
</nav>

<!-- Form dan Detail Trip -->
<div class="main-content">
    <div class="container container-custom">
        <div class="row g-0" style="flex: 1;">

            <!-- Form Pemesanan -->
            <div class="col-md-6 form-section">
                <h2 class="form-title">Form Pesan Trip Wisata</h2>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('form.pesan.trip.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $trip_wisata->id_trip_wisata }}">
                    <input type="hidden" name="action" id="action" value="bayar">

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ $tanggal }}" class="form-control" readonly style="background-color: #f8f9fa;">
                        @error('tanggal')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
                        <input type="number" name="jumlah_orang" id="jumlah_orang" class="form-control" min="1" required>
                        @error('jumlah_orang')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sub Total</label>
                        <input type="text" id="subtotal_display" class="form-control" readonly>
                        <input type="hidden" name="subtotal" id="subtotal">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total Harga</label>
                        <input type="text" id="total_display" class="form-control" readonly>
                        <input type="hidden" name="total" id="total">
                        @error('total')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-50" onclick="document.getElementById('action').value='bayar';">
                        Pesan Sekarang
                    </button>
                </form>
            </div>

            <!-- Detail Trip -->
            <div class="col-md-6 detail-section">
                <div class="text-center mb-3">
                    <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo" style="height: 60px;">
                </div>

                <h3 class="fw-bold">{{ $trip_wisata->nama_trip }}</h3>

                <h6>Fasilitas</h6>
                <div class="mb-4">
                    @foreach (explode("\n", $trip_wisata->fasilitas) as $fasilitas)
                        @if(trim($fasilitas))
                            <div style="display: block; margin-bottom: 10px;">
                                <i class="fa fa-check-circle text-success" style="margin-right: 8px;"></i>
                                <span>{{ trim($fasilitas) }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>

                <h6>Destinasi</h6>
                <div class="mb-4">
                    @foreach (explode("\n", $trip_wisata->destinasi) as $destinasi)
                        @if(trim($destinasi))
                            <div style="display: block; margin-bottom: 10px;">
                                <i class="fa fa-check-circle text-success" style="margin-right: 8px;"></i>
                                <span>{{ trim($destinasi) }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="bg-light-custom">
                    <p class="mb-1 fw-bold">Harga per Orang</p>
                    <strong id="harga_satuan" data-harga="{{ $trip_wisata->harga }}">
                        Rp {{ number_format($trip_wisata->harga, 0, ',', '.') }}
                    </strong>
                </div>
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

<script>
    const hargaPerOrang = parseInt(document.getElementById('harga_satuan').getAttribute('data-harga'));
    const jumlahOrang = document.getElementById('jumlah_orang');
    const subtotalDisplay = document.getElementById('subtotal_display');
    const subtotal = document.getElementById('subtotal');
    const totalDisplay = document.getElementById('total_display');
    const total = document.getElementById('total');

    function hitungTotal() {
        const jumlah = parseInt(jumlahOrang.value) || 0;
        const totalHarga = hargaPerOrang * jumlah;
        
        if (jumlah > 0) {
            subtotalDisplay.value = `Rp ${hargaPerOrang.toLocaleString('id-ID')} x ${jumlah}`;
            totalDisplay.value = `Rp ${totalHarga.toLocaleString('id-ID')}`;
        } else {
            subtotalDisplay.value = '';
            totalDisplay.value = '';
        }
        
        subtotal.value = totalHarga;
        total.value = totalHarga;
    }

    jumlahOrang.addEventListener('input', hitungTotal);
    jumlahOrang.addEventListener('change', hitungTotal);
    window.addEventListener('DOMContentLoaded', hitungTotal);
</script>
</body>
</html>