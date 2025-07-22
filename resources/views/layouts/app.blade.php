<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teluk Biru Homestay</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Tailwind CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
            padding-top: 80px;
            /* Supaya konten tidak tertutup header */
        }

        .header-bar {
            position: fixed;
            top: 0;
            left: 220px;
            right: 0;
            height: 80px;
            /* Tinggi header disamakan dengan tinggi sidebar-logo */
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
            height: 80px;
            /* Disamakan dengan header */
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
    </style>
</head>

<body>
    @yield('scripts')

    {{-- Sidebar with Logo --}}
    <div class="sidebar">
        {{-- Logo Section --}}
        <div class="sidebar-logo">
            <img src="{{ asset('foto/logo-tbh.png') }}" alt="Logo" />
            <p class="logo-text">Teluk Biru Homestay</p>
        </div>

        {{-- Menu Section --}}
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('pemesanan.index') }}"
                    class="{{ request()->routeIs('pemesanan.*') ? 'active' : '' }}">
                    Data Pemesanan
                </a>
            </li>
            <li>
                <a href="{{ route('penginapan.index') }}"
                    class="{{ request()->routeIs('penginapan.*') ? 'active' : '' }}">
                    Penginapan
                </a>
            </li>
            <li>
                <a href="{{ route('trip_wisata.index') }}"
                    class="{{ request()->routeIs('trip_wisata.*') ? 'active' : '' }}">
                    Trip Wisata
                </a>
            </li>
            <li>
                <a href="{{ route('pembayaran.index') }}"
                    class="{{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">
                    Pembayaran
                </a>
            </li>
            <li>
                <a href="{{ route('riwayat.index') }}"
                    class="{{ request()->routeIs('riwayat.*') ? 'active' : '' }}">
                    Riwayat Pemesanan
                </a>
            </li>
            <li>
                <a href="{{ route('profil.index') }}"
                    class="{{ request()->routeIs('profil.*') ? 'active' : '' }}">
                    Profil Perusahaan
                </a>
            </li>
        </ul>
    </div>

    {{-- Header (hanya user info) --}}
  

    {{-- Main Content Area --}}
    <main class="main-content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>