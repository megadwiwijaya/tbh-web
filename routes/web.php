<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{

    DashboardAdminController,
    KamarController,
    TripWisataController,
    DetailKamarController,
    DetailTripWisataController,
    BerandaController,
    FormPesanKamarController,
    FormPesanTripWisataController,
    SesiController,
    ProfilPelangganController,
    AdminProfileController,
    UploadBuktiController,
    RegisterController,
    KamarPelangganController,
    TripWisataPelangganController,
    PembayaranTripController,
    PembayaranKamarController,
    AdminPemesananController,
    AdminPembayaranController,
    
};


Route::middleware(['guest'])->group(function () {
    // Login
    Route::get('/', [SesiController::class, 'index'])->name('login'); // ✅ route '/' untuk halaman login
    Route::post('login', [SesiController::class, 'login'])->name('login.proses');

    // Register
    Route::get('register', [RegisterController::class, 'show'])->name('register'); // ✅ methodnya 'show'
    Route::post('register', [RegisterController::class, 'store'])->name('register.store'); // ✅ methodnya 'store'
});
// ------------------------------
// RUTE PUBLIK (TIDAK PERLU LOGIN)
// ------------------------------
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
})->name('tentang.kami');

// Lihat daftar kamar & trip tanpa login
Route::get('/pelanggan/kamar', [KamarPelangganController::class, 'index'])->name('kamar.pelanggan');
Route::get('/pelanggan/trip', [TripWisataPelangganController::class, 'index'])->name('trip.pelanggan');


// Detail juga boleh dilihat tanpa login
Route::get('/pelanggan/kamar/{id}/detail', [DetailKamarController::class, 'show'])->name('kamar.detail');
Route::get('/pelanggan/trip/{id}/detail', [DetailTripWisataController::class, 'show'])->name('trip.detail');

// ------------------------------
// RUTE PENGGUNA SUDAH LOGIN
// ------------------------------
Route::middleware(['auth'])->group(function () {

    // Redirect berdasarkan role setelah login
    Route::get('home', function () {
        $role = auth()->user()->role;
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'pelanggan' => redirect()->route('pelanggan.profil'),
            default => abort(403),
        };
    });

    // ------------------------------
    // RUTE ADMIN
    // ------------------------------
    Route::middleware(['userAkses:admin'])->prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    });   
    
    // ------------------------------
    // RUTE PELANGGAN
    // ------------------------------
    Route::middleware('userAkses:pelanggan')->prefix('pelanggan')->group(function () {


            // Form Pemesanan Kamar
            Route::get('/form-pesan-kamar/{id}', [FormPesanKamarController::class, 'create'])->name('form.pesan.kamar');
            Route::post('/form-pesan-kamar/store', [FormPesanKamarController::class, 'store'])->name('form.pesan.kamar.store');

            // Pembayaran Kamar
            Route::get('/kamar/pembayaran/{id}', [PembayaranKamarController::class, 'show'])->name('pembayaran.kamar.show');
            Route::post('/kamar/pembayaran/{id}', [PembayaranKamarController::class, 'proses'])->name('pembayaran.kamar.proses');
            // Form Pesan Trip Wisata
            
            Route::get('/form-pesan-trip/{id}', [FormPesanTripWisataController::class, 'create'])->name('form.pesan.trip');
            Route::post('/form-pesan-trip/store', [FormPesanTripWisataController::class, 'store'])->name('form.pesan.trip.store');

            // FORM PEMBAYARAN (GET)
            Route::get('/trip/pembayaran/{id}', [PembayaranTripController::class, 'show'])->name('pembayaran.trip.show'); // Ubah 'form' menjadi 'show'

            // PROSES PEMBAYARAN (POST)
            Route::post('/trip/pembayaran/{id}', [PembayaranTripController::class, 'proses'])->name('pembayaran.trip.proses');

        // Upload Bukti Pembayaran
        Route::post('/uploadbukti', [UploadBuktiController::class, 'store'])->name('upload.bukti.store');

        // Profil Pelanggan
        Route::get('/profil', [ProfilPelangganController::class, 'index'])->name('pelanggan.profil');
        Route::post('/profil/update', [ProfilPelangganController::class, 'update'])->name('pelanggan.profil.update');

        // Keranjang (jika ada)
        Route::prefix('keranjang')->name('keranjang.')->group(function () {
            Route::get('/', [KeranjangController::class, 'index'])->name('index');
            Route::get('/{id_pemesanan}/edit', [KeranjangController::class, 'edit'])->name('edit');
            Route::put('/{id_pemesanan}', [KeranjangController::class, 'update'])->name('update');
            Route::post('/bayar', [KeranjangController::class, 'bayar'])->name('bayar');
        });

    });

    // ------------------------------
    // RUTE ADMIN
    // ------------------------------
    Route::middleware('userAkses:admin')->prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

        Route::get('/profil', [AdminProfileController::class, 'index'])->name('admin.profil');

        // Kamar 
        Route::prefix('kamar')->name('kamar.')->group(function () {
            Route::get('/', [KamarController::class, 'index'])->name('index');
            Route::get('/create', [KamarController::class, 'create'])->name('create');
            Route::post('/store', [KamarController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [KamarController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [KamarController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [KamarController::class, 'destroy'])->name('destroy');
        });

        // Trip Wisata
        Route::prefix('trip-wisata')->name('trip_wisata.')->group(function () {
            Route::get('/', [TripWisataController::class, 'index'])->name('index');
            Route::get('/create', [TripWisataController::class, 'create'])->name('create');
            Route::post('/store', [TripWisataController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [TripWisataController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [TripWisataController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [TripWisataController::class, 'destroy'])->name('destroy');
        });

            // Pemesanan & Pembayaran
            Route::get('/pemesanan', [AdminPemesananController::class, 'index'])->name('admin.pemesanan');
            Route::put('/pemesanan/{id}/update-status', [AdminPemesananController::class, 'updateStatus'])->name('admin.pemesanan.updateStatus');
            Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('admin.pembayaran');
            Route::put('/pembayaran/{id}/update-status', [AdminPembayaranController::class, 'updateStatus'])->name('admin.pembayaran.updateStatus');

    });

    // ------------------------------
    // LOGOUT
    // ------------------------------
    Route::post('logout', [SesiController::class, 'logout'])->name('logout');
});

