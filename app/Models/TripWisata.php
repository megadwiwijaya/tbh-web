<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripWisata extends Model
{
    use HasFactory;

    protected $table = 'trip_wisata';

    protected $primaryKey = 'id_trip_wisata';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_trip_wisata',
        'nama_trip',
        'destinasi',
        'fasilitas',
        'harga',
        'foto'
    ];
    
}
