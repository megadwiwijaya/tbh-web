<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->string('id_pembayaran', 15)->primary(); // Sinkron dengan panjang id_pembayaran di pemesanan
            $table->date('tanggal');
            $table->string('bukti'); // path gambar bukti transfer
            $table->enum('keterangan', ['DP', 'Lunas']); // jenis pembayaran
            $table->enum('status', ['pending', 'setuju', 'ditolak'])->default('pending');
            $table->decimal('sisa_tagihan', 12, 2)->default(0);
            $table->decimal('total_bayar', 12, 2);
            $table->string('id_pemesanan', 15); // Foreign key ke pemesanan
            $table->foreign('id_pemesanan')->references('id_pemesanan')->on('pemesanan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};