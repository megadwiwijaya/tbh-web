<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->string('id_pemesanan', 15)->primary();
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->string('jumlah_orang', 5)->nullable();
            $table->enum('status', ['check_in', 'check_out', 'berlangsung', 'selesai']);
            $table->string('id_user', 15);
            $table->string('id_kamar', 15)->nullable();
            $table->string('id_trip_wisata', 15)->nullable();
            $table->string('id_pembayaran', 15)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('pemesanan');
    }
};