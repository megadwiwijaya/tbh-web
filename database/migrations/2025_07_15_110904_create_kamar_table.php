<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kamar', function (Blueprint $table) {
            $table->string('id_kamar', 15)->primary();
            $table->string('nama_tipe_kamar', 15);
            $table->text('fasilitas');
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->enum('status', ['tersedia', 'dipesan'])->default('tersedia');
            $table->string('foto', 255)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('kamar');
    }
};