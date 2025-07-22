<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';
    protected $primaryKey = 'id_ulasan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_ulasan',
        'rating',
        'komentar',
        'id_pemesanan',
    ];

    // Relasi ke tabel pemesanan
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}
