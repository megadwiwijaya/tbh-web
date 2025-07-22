<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; // Nama tabel
    protected $primaryKey = 'id_pembayaran';
    public $incrementing = false; // Karena pakai varchar, bukan auto increment
    protected $keyType = 'string'; // id_pembayaran adalah varchar

    protected $fillable = [
        'id_pembayaran',
        'tanggal',
        'bukti',
        'keterangan',       // enum: 'DP', 'Lunas'
        'status',           // enum: 'pending', 'setuju', 'ditolak'
        'sisa_tagihan',
        'total_bayar',
        'id_pemesanan',     // Foreign key ke tabel pemesanan
    ];

    protected $casts = [
        'tanggal' => 'date',
        'sisa_tagihan' => 'decimal:2',
        'total_bayar' => 'decimal:2',
    ];

    /**
     * Relasi ke tabel pemesanan
     */
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }
}