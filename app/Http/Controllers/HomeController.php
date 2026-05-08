<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil data user yang sedang login untuk dipersonalisasi
        $user = Auth::user();

        // Di aplikasi enterprise, kita bisa mengirim data statistik di sini
        // Contoh: $jumlahMahasiswa = Mahasiswa::count();

        return view('home', [
            'user' => $user,
            'waktu' => date('H:i'),
            'status' => 'Aktif'
        ]);
    }
}
