<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Pengguna</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background-color: #f9f9f9;
    }
    .container {
      max-width: 1140px;
      margin: 40px auto;
      display: grid;
      grid-template-columns: 260px 1fr;
      gap: 24px;
    }
    .sidebar {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }
    .sidebar a {
      display: block;
      padding: 14px 20px;
      color: #333;
      text-decoration: none;
      border-bottom: 1px solid #eee;
      font-weight: 500;
    }
    .sidebar a.active, .sidebar a:hover {
      background-color: #1e88e5;
      color: white;
    }

    .sidebar {
    display: flex;
    flex-direction: column;
    height: fit-content;
}
    .card {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
      padding: 32px;
    }
    .form-control {
      width: 100%;
      padding: 10px 14px;
      margin-top: 6px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }
    label {
      font-weight: 500;
    }
    .btn-primary {
      background-color: #1e88e5;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 20px;
      cursor: pointer;
      font-size: 14px;
      transition: background-color 0.3s;
    }
    .btn-primary:hover {
      background-color: #1565c0;
    }
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 14px 24px;
      background-color: white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    }
    .navbar ul {
      display: flex;
      gap: 24px;
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .navbar a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }
    .navbar a.active {
      color: #1e88e5;
    }
    footer {
      background-color: #f4f4f4;
      margin-top: 60px;
    }
    footer .footer-content {
      padding: 40px 60px 0;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 40px;
    }
    footer p, footer a {
      color: #555;
      font-size: 14px;
    }
    footer a {
      text-decoration: none;
    }
    footer a:hover {
      text-decoration: underline;
    }
    .footer-bottom {
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
  <div style="display: flex; align-items: center; gap: 16px;">
    <button style="border: 1px solid #000; border-radius: 20px; padding: 6px 12px; background: white; cursor: pointer; font-size: 14px;">👤 Pengguna</button>
  </div>
</nav>

<!-- Konten Utama -->
<div class="container">
  <!-- Sidebar -->
  <div class="sidebar">
    <a href="#" class="active">Akun</a>
    <a href="#">Riwayat</a>
    <a href="#">Ulasan</a>
    <!-- Button Logout -->
<form action="{{ route('logout') }}" method="POST" style="margin-top: auto; border-top: 1px solid #eee;">
    @csrf
    <button type="submit" style="width: 100%; padding: 14px 20px; background-color: #dc3545; color: white; border: none; font-weight: 500; font-size: 14px; font-family: 'Inter', sans-serif; cursor: pointer;">
        Logout
    </button>
</form>
  </div>

  <!-- Form Profil -->
  <div class="card">
    <h4 style="margin-bottom: 24px;">Akun Saya</h4>
    <form action="{{ route('pelanggan.profil.update') }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" value="{{ Auth::user()->nama }}">
      </div>
      <div class="mb-3">
        <label>Alamat</label>
        <input type="text" class="form-control" name="alamat" value="{{ Auth::user()->alamat }}">
      </div>
      <div class="mb-3">
        <label>No. Telepon</label>
        <input type="text" class="form-control" name="no_hp" value="{{ Auth::user()->no_hp }}">
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
      </div>
      <div class="mb-3">
        <label>Password Baru</label>
        <input type="password" class="form-control" name="password">
      </div>
      <button class="btn-primary">Simpan Perubahan</button>
    </form>
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
