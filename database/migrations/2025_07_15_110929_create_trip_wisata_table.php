<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('trip_wisata', function (Blueprint $table) {
            $table->string('id_trip_wisata', 15)->primary();
            $table->string('nama_trip', 50);
            $table->text('destinasi');
            $table->text('fasilitas');
            $table->decimal('harga', 10, 2);
            $table->string('foto', 255)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('trip_wisata');
    }
};