<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    public $incrementing = false; // Karena ID-nya bertipe varchar
    protected $keyType = 'string';

    protected $fillable = [
        'id_pemesanan',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah_orang',
        'status',
        'id_user',
        'id_kamar',
        'id_trip_wisata',
        'id_pembayaran',
    ];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke tabel Kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }

    // Relasi ke tabel Trip Wisata
    public function tripWisata()
    {
        return $this->belongsTo(TripWisata::class, 'id_trip_wisata');
    }

    // Relasi ke tabel Pembayaran
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pemesanan', 'id_pemesanan');
    }

    // Relasi ke tabel Ulasan
    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'id_pemesanan');
    }
}