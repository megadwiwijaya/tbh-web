<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUlasanTable extends Migration
{
    public function up()
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->string('id_ulasan', 15)->primary();
            $table->decimal('rating', 3, 2)->nullable();
            $table->string('komentar', 225)->nullable();
            $table->string('id_pemesanan', 30);

            $table->timestamps();

            $table->foreign('id_pemesanan')
                ->references('id_pemesanan')
                ->on('pemesanan')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ulasan');
    }
}
