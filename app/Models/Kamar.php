<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar'; // Nama tabel

    protected $primaryKey = 'id_kamar';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kamar',
        'nama_tipe_kamar',
        'fasilitas',
        'deskripsi',
        'harga',
        'foto',
    ];

    // Relasi ke tabel foto_kamar
    public function fotoKamar()
    {
        return $this->hasMany(FotoKamar::class, 'id_kamar', 'id_kamar');
    }
}
