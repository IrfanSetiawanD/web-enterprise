<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'mahasiswa';

    // Primary key tabel
    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'jurusan',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp'
    ];
}
