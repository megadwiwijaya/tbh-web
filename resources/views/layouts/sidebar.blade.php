<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teluk Biru Homestay</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
            padding-top: 80px; /* Supaya konten tidak tertutup header */
        }

        .header-bar {
            position: fixed;
            top: 0;
            left: 220px;
            right: 0;
            height: 80px; /* Tinggi header disamakan dengan tinggi sidebar-logo */
            background-color: #f9f9f9;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid #ddd;
            z-index: 1000;
        }

        .header-bar .user-info {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: bold;
            color: #333;
            font-size: 16px;
        }

        .header-bar .user-icon {
            font-size: 18px;
        }

        .content-area {
            margin-top: 80px;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            height: 100vh;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
            overflow-y: auto;
            z-index: 1001;
        }

        .sidebar-logo {
            height: 80px; /* Disamakan dengan header */
            padding: 0 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border-bottom: 1px solid #dee2e6;
            background-color: #fff;
            text-align: center;
        }

        .sidebar-logo img {
            height: 40px;
            margin-bottom: 5px;
        }

        .sidebar-logo .logo-text {
            font-size: 15px;
            font-weight: bold;
            color: #333;
            margin: 0;
            line-height: 1.1;
        }

        .sidebar-menu {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .sidebar-menu li {
            border-bottom: 1px solid #eee;
        }

        .sidebar-menu li a {
            display: block;
            padding: 15px 20px;
            color: #6c757d;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-menu li a:hover {
            background-color: #e9ecef;
            color: #495057;
        }

        .sidebar-menu li.active a {
            background-color: #007bff;
            color: white;
        }

        .user-info {
            font-size: 16px;
            color: #333;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
        }

        .sidebar-menu a.active {
        font-weight: bold;
        color: #007bff;
        background-color: #f0f0f0;
    }

    </style>
</head>
<body>
     @yield('scripts')

{{-- Sidebar with Logo --}}
<div class="sidebar d-flex flex-column justify-between min-vh-100 bg-light" style="font-size: 0.9rem;">
    {{-- Logo Section --}}
    <div class="sidebar-logo p-2 text-center">
        <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo" class="img-fluid mb-1" style="max-height: 50px;" />
        <p class="logo-text fw-bold" style="font-size: 0.85rem;">Teluk Biru Homestay</p>
    </div>

    {{-- Menu Section --}}
    <ul class="sidebar-menu flex-grow-1 list-unstyled px-2">
        <li class="mb-1">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active text-primary fw-bold' : 'text-dark' }}">
                <i class="bi bi-house-door me-1"></i> Dashboard
            </a>
        </li>

        <li class="mb-1">
            <a href="{{ route('admin.pemesanan') }}"
               class="nav-link {{ request()->routeIs('admin.pemesanan') ? 'active text-primary fw-bold' : 'text-dark' }}">
                <i class="bi bi-file-earmark-text me-1"></i> Data Pemesanan
            </a>
        </li>

        <li class="mb-1">
            <a href="{{ route('kamar.index') }}"
               class="nav-link {{ request()->routeIs('kamar.*') ? 'active text-primary fw-bold' : 'text-dark' }}">
                <i class="bi bi-building me-1"></i> Kamar
            </a>
        </li>

        <li class="mb-1">
            <a href="{{ route('trip_wisata.index') }}"
               class="nav-link {{ request()->routeIs('trip_wisata.*') ? 'active text-primary fw-bold' : 'text-dark' }}">
                <i class="bi bi-map me-1"></i> Trip Wisata
            </a>
        </li>

        <li class="mb-1">
            <a href="{{ route('admin.pembayaran') }}"
               class="nav-link {{ request()->routeIs('admin.pembayaran') ? 'active text-primary fw-bold' : 'text-dark' }}">
                <i class="bi bi-cash-stack me-1"></i> Data Pembayaran
            </a>
        </li>

        <li class="mb-1">
            <a href="#" class="nav-link text-dark">
                <i class="bi bi-clock-history me-1"></i> Riwayat Pemesanan
            </a>
        </li>

        <li class="mb-1">
            <a href="#" class="nav-link text-dark">
                <i class="bi bi-building-gear me-1"></i> Profil Perusahaan
            </a>
        </li>
    </ul>

    {{-- Logout Button --}}
    <div class="px-2 mb-3 mt-2">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center py-1" style="font-size: 0.85rem;">
                <i class="bi bi-box-arrow-right me-1" style="font-size: 1rem;"></i> Logout
            </button>
        </form>
    </div>
</div>

    {{-- Header (hanya user info) --}}
<div class="header-bar">
    <div class="user-info">
        <a href="{{ route('admin.profil') }}" style="text-decoration: none; color: inherit;">
            <span class="fw-bold">Admin</span>
            <span class="user-icon">👤</span>
        </a>
    </div>
</div>

    {{-- Main Content Area --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- SweetAlert Success Notification --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
</body>
</html>
