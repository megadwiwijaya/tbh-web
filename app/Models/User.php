<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';           // Nama tabel
    protected $primaryKey = 'id_user';    // Primary key bukan 'id'
    public $incrementing = false;         // Karena id_user adalah string (bukan auto increment)
    protected $keyType = 'string';        // Tipe data untuk id_user (VARCHAR)

    protected $fillable = [
        'id_user',
        'nama',
        'email',
        'password',
        'alamat',
        'no_hp',
        'foto',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
