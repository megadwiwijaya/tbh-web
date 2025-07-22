<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Trip Wisata</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex: 1;
            padding-top: 70px;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 24px;
            background: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, h4 {
            margin-bottom: 16px;
            color: #333;
        }
        .card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
        .col-md-6 {
            flex: 0 0 48%;
            max-width: 48%;
        }
        .col-md-8 {
            flex: 0 0 64%;
            max-width: 64%;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .trip-image img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
        }
        .trip-image span {
            display: block;
            text-align: center;
            color: #666;
            padding: 10px;
            background: #e0e0e0;
            border-radius: 8px;
        }
        .payment-method-card {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 24px;
            background: white;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }
        .payment-method-card:hover {
            border-color: #1e88e5;
            transform: translateY(-2px);
        }
        .payment-method-card.active {
            border-color: #1e88e5;
            background-color: #f0f8ff;
        }
        .payment-method-card h5 {
            margin: 0 0 10px 0;
            color: #1e88e5;
            font-size: 18px;
        }
        .payment-method-card p {
            color: #666;
            margin: 0 0 10px 0;
        }
        .total-display {
            font-size: 20px;
            font-weight: bold;
            color: #1e88e5;
            background-color: #f0f8ff;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin: 15px 0;
        }
        .upload-section {
            display: none;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }
        .upload-section.active {
            display: block;
        }
        .upload-area {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 30px 20px;
            text-align: center;
            background-color: #fafafa;
            margin-top: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .upload-area:hover {
            border-color: #1e88e5;
            background-color: #f0f8ff;
        }
        .upload-area.has-file {
            border-color: #4caf50;
            background-color: #f1f8e9;
        }
        .file-name {
            margin-top: 10px;
            color: #1e88e5;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .payment-info-card {
            background: linear-gradient(135deg, #e7f3ff 0%, #cce7ff 100%);
            border-left: 4px solid #1e88e5;
        }
        .alert {
            padding: 16px;
            margin-bottom: 20px;
            border-radius: 6px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .btn {
            padding: 12px 24px;
            border: none;
            background-color: #1e88e5;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 8px;
            width: auto;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #1565c0;
        }
        .btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 24px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        .navbar ul {
            display: flex;
            gap: 24px;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .navbar ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }
        .navbar ul li a.active {
            color: #007BFF;
        }
        footer {
            background-color: #f4f4f4;
            margin-top: auto;
            padding: 40px 0;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 60px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 40px;
        }
        .footer-section {
            flex: 1;
            min-width: 200px;
        }
        .footer-section img {
            height: 50px;
            margin-bottom: 16px;
        }
        .footer-section p, .footer-section ul {
            color: #555;
            margin: 0;
            line-height: 1.6;
        }
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        .footer-section ul li {
            margin-bottom: 8px;
        }
        .footer-section ul li a {
            text-decoration: none;
            color: black;
        }
        .footer-bottom {
            text-align: center;
            padding: 16px 0;
            background-color: #1e88e5;
            color: white;
            margin-top: 40px;
        }
        .radio-input {
            display: none;
        }
        .text-end {
            text-align: right;
        }
        .success-message {
            display: none;
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 6px;
            margin: 20px 0;
            text-align: center;
        }
        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }
            .col-md-4, .col-md-6, .col-md-8 {
                flex: none;
                max-width: 100%;
            }
            .navbar {
                flex-direction: column;
                padding: 12px;
            }
            .navbar ul {
                margin-top: 10px;
                gap: 15px;
            }
            .footer-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .footer-section {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar">
            <div>
                <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo" style="height: 40px;">
            </div>
            <ul>
                <li><a href="{{ route('beranda') }}" class="active">Beranda</a></li>
                <li><a href="{{ route('tentang.kami') }}">Tentang Kami</a></li>
                <li><a href="{{ route('kamar.pelanggan') }}">Kamar</a></li>
                <li><a href="#">Trip Wisata</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
            <div>
                <button style="border: 1px solid #000; border-radius: 20px; padding: 6px 12px; background: white; cursor: pointer; font-size: 14px;">👤 Pengguna</button>
            </div>
        </nav>

        <!-- Detail Pemesanan Trip -->
        <div class="container">
            <div class="card">
                <div class="row">
                    <div class="col-md-4">
                        <div class="trip-image">
                            @if($pemesanan->tripWisata->foto)
                                <img src="{{ asset('storage/' . $pemesanan->tripWisata->foto) }}" alt="{{ $pemesanan->tripWisata->nama_trip }}" class="img-fluid">
                            @else
                                <span>Foto Tidak Tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h5>{{ $pemesanan->tripWisata->nama_trip ?? 'Paket Trip Wisata' }}</h5>
                        <p><strong>ID Pemesanan:</strong> {{ $pemesanan->id_pemesanan ?? '223' }}</p>
                        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->format('d M Y') ?? '20 Jul 2025' }}</p>
                        <p><strong>Jumlah Orang:</strong> {{ $pemesanan->jumlah_orang ?? '3' }} Orang</p>
                        <p><strong>Harga per Orang:</strong> Rp {{ number_format($pemesanan->tripWisata->harga ?? 300000, 0, ',', '.') }}</p>
                        <p><strong>Total Bayar:</strong> Rp {{ number_format(($pemesanan->jumlah_orang * $pemesanan->tripWisata->harga) ?? (($pemesanan->jumlah_orang ?? 3) * ($pemesanan->tripWisata->harga ?? 300000)), 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

<!-- Form Pembayaran -->
<div class="container">
    <form id="paymentForm" action="{{ route('pembayaran.trip.proses', $pemesanan->id_pemesanan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $pemesanan->id_pemesanan }}">

        @php
            $totalHarga = ($pemesanan->jumlah_orang * $pemesanan->tripWisata->harga) ?? (($pemesanan->jumlah_orang ?? 3) * ($pemesanan->tripWisata->harga ?? 300000));
            $totalDP = $totalHarga * 0.5;
        @endphp

        <h4>Pilih Metode Pembayaran</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="payment-method-card" id="dp-card" onclick="selectPayment('DP', this)">
                    <input type="radio" name="metode" value="DP" id="dp_option" class="radio-input">
                    <h5><i class="fas fa-percentage" style="margin-right: 10px;"></i>Pembayaran DP (50%)</h5>
                    <p>Bayar 50% dari total harga sekarang</p>
                    <div class="total-display">
                        Total DP: <strong>Rp {{ number_format($totalDP, 0, ',', '.') }}</strong>
                    </div>
                    <div class="upload-section" id="dp-upload" style="display: none;">
                        <label>Upload Bukti Transfer</label>
                        <div class="upload-area" id="dp-upload-area" onclick="document.getElementById('bukti_dp').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Klik untuk upload atau drag & drop</p>
                            <small>Format: JPG, PNG. Maksimal 2MB</small>
                            <div id="dp-filename" class="file-name"></div>
                        </div>
                        <input type="file" id="bukti_dp" name="bukti_dp" accept="image/*" style="display: none;" onchange="handleFileSelect('dp')">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="payment-method-card" id="lunas-card" onclick="selectPayment('Lunas', this)">
                    <input type="radio" name="metode" value="Lunas" id="lunas_option" class="radio-input">
                    <h5><i class="fas fa-check-circle" style="margin-right: 10px;"></i>Pembayaran Lunas</h5>
                    <p>Bayar full amount sekarang</p>
                    <div class="total-display">
                        Total Lunas: <strong>Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong>
                    </div>
                    <div class="upload-section" id="lunas-upload" style="display: none;">
                        <label>Upload Bukti Transfer</label>
                        <div class="upload-area" id="lunas-upload-area" onclick="document.getElementById('bukti_lunas').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Klik untuk upload atau drag & drop</p>
                            <small>Format: JPG, PNG. Maksimal 2MB</small>
                            <div id="lunas-filename" class="file-name"></div>
                        </div>
                        <input type="file" id="bukti_lunas" name="bukti_lunas" accept="image/*" style="display: none;" onchange="handleFileSelect('lunas')">
                    </div>
                </div>
            </div>
        </div>

        <div class="card payment-info-card">
            <h6><i class="fas fa-info-circle" style="margin-right: 10px;"></i>Informasi Pembayaran:</h6>
            <div>
                <p><strong>Bank BCA</strong></p>
                <p>No. Rekening: <strong>1234567890</strong></p>
                <p>Atas Nama: <strong>Teluk Biru Homestay</strong></p>
            </div>
        </div>

        <input type="hidden" id="total_bayar" name="total_bayar" value="0">

        <div style="text-align: center;">
            <button type="submit" class="btn" id="submit-btn" disabled>
                <i class="fas fa-paper-plane" style="margin-right: 8px;"></i>Kirim Pembayaran
            </button>
        </div>
    </form>
</div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
            <div class="footer-section">
                <ul>
                    <li style="font-weight: bold; margin-bottom: 8px;"></li>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li><a href="{{ route('tentang.kami') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('kamar.pelanggan') }}">Kamar</a></li>
                    <li><a href="#">Trip Wisata</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <p style="font-weight: bold; margin-bottom: 8px;">Kontak Kami</p>
                <p><i class="fas fa-envelope" style="margin-right: 8px;"></i>biruhomestay@mail.com</p>
                <p><i class="fab fa-instagram" style="margin-right: 8px;"></i>villatelukbiru</p>
                <p><i class="fab fa-whatsapp" style="margin-right: 8px;"></i>0812-3456-7891</p>
            </div>
        </div>
        <div class="footer-bottom">
            Copyright © 2025 Teluk Biru Homestay
        </div>
    </footer>

<script>
    const totalHarga = 900000; // Nilai default sederhana
    const totalBayarInput = document.getElementById('total_bayar');

    function selectPayment(method, element) {
        document.querySelectorAll('.payment-method-card').forEach(option => {
            option.classList.remove('active');
        });
        element.classList.add('active');
        const radio = element.querySelector('input[type="radio"]');
        radio.checked = true;
        document.getElementById('dp-upload').style.display = 'none';
        document.getElementById('lunas-upload').style.display = 'none';
        if (method === 'DP') {
            document.getElementById('dp-upload').style.display = 'block';
            totalBayarInput.value = Math.round(totalHarga * 0.5);
        } else if (method === 'Lunas') {
            document.getElementById('lunas-upload').style.display = 'block';
            totalBayarInput.value = totalHarga;
        }
        updateSubmitButton();
    }

    function handleFileSelect(type) {
        const fileInput = type === 'dp' ? document.getElementById('bukti_dp') : document.getElementById('bukti_lunas');
        const filenameDiv = document.getElementById(`${type}-filename`);
        const uploadArea = document.getElementById(`${type}-upload-area`);
        const file = fileInput.files[0];
        filenameDiv.innerText = '';
        uploadArea.classList.remove('has-file');
        if (file) {
            if (!file.type.startsWith('image/')) {
                alert('Harap pilih file gambar (JPG, PNG)');
                fileInput.value = '';
                return;
            }
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB');
                fileInput.value = '';
                return;
            }
            filenameDiv.innerText = file.name;
            filenameDiv.style.color = '#28a745';
            uploadArea.classList.add('has-file');
        }
        updateSubmitButton();
    }

    function updateSubmitButton() {
        const dpFile = document.getElementById('bukti_dp').files.length > 0;
        const lunasFile = document.getElementById('bukti_lunas').files.length > 0;
        const btn = document.getElementById('submit-btn');
        const metodeSelected = document.querySelector('input[name="metode"]:checked');
        btn.disabled = !(metodeSelected && (dpFile || lunasFile));
    }

    function setupDragAndDrop(uploadAreaId, fileInputId) {
        const area = document.getElementById(uploadAreaId);
        const input = document.getElementById(fileInputId);
        if (!area || !input) return;
        ['dragover', 'dragenter'].forEach(eventName => {
            area.addEventListener(eventName, e => {
                e.preventDefault();
                area.style.borderColor = '#1e88e5';
                area.style.backgroundColor = '#f0f8ff';
            });
        });
        ['dragleave', 'dragend'].forEach(eventName => {
            area.addEventListener(eventName, e => {
                e.preventDefault();
                area.style.borderColor = '#ccc';
                area.style.backgroundColor = '#fafafa';
            });
        });
        area.addEventListener('drop', e => {
            e.preventDefault();
            area.style.borderColor = '#ccc';
            area.style.backgroundColor = '#fafafa';
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const dt = new DataTransfer();
                dt.items.add(files[0]);
                input.files = dt.files;
                handleFileSelect(fileInputId === 'bukti_dp' ? 'dp' : 'lunas');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        setupDragAndDrop('dp-upload-area', 'bukti_dp');
        setupDragAndDrop('lunas-upload-area', 'bukti_lunas');
    });

    document.getElementById('paymentForm').addEventListener('submit', e => {
        e.preventDefault();
        const metodeSelected = document.querySelector('input[name="metode"]:checked');
        const dpFile = document.getElementById('bukti_dp').files.length > 0;
        const lunasFile = document.getElementById('bukti_lunas').files.length > 0;
        if (!metodeSelected) {
            alert('Silakan pilih metode pembayaran terlebih dahulu');
            return false;
        }
        if (!dpFile && !lunasFile) {
            alert('Silakan pilih bukti transfer terlebih dahulu');
            return false;
        }
        console.log('Processing payment with:', { 
            metode: metodeSelected.value, 
            file: dpFile ? 'DP file' : 'Lunas file',
            total: totalBayarInput.value 
        });
        // Redirect langsung ke beranda setelah submit sukses
        window.location.href = '/beranda';
    });
</script>
</body>
</html>