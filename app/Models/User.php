<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel di database
    protected $table = 'users';

    // Primary key kustom sesuai permintaan
    protected $primaryKey = 'id_user';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     */
    protected $fillable = [
        'name', // Menambahkan kolom nama untuk identitas mahasiswa/admin
        'username',
        'email',
        'password',
        'role',
        'verify_key',
        'active'
    ];

    /**
     * Atribut yang harus disembunyikan untuk serialisasi (Keamanan).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atribut yang harus dikonversi tipenya.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
