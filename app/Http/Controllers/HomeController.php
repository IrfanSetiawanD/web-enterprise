<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\MahasiswaModel;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Ambil semua data mahasiswa agar tabel di view 'home' terisi
        $mahasiswa = MahasiswaModel::all();

        return view('home', [
            'user' => $user,
            'mahasiswa' => $mahasiswa, // Kirim variabel ini ke view
            'waktu' => date('H:i'),
            'status' => 'Aktif'
        ]);
    }
}
