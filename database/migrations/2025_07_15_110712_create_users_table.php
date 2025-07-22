<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('users', function (Blueprint $table) {
        $table->string('id_user', 15)->primary();         
        $table->string('email')->unique();        // username berupa email
        $table->string('nama');                   // nama lengkap
        $table->string('password');               // password terenkripsi
        $table->text('alamat')->nullable();       // alamat boleh kosong
        $table->string('no_hp')->nullable();      // no hp boleh kosong
        $table->string('role')->default('pelanggan'); // default role
        $table->rememberToken();                  // untuk fitur "remember me"
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
