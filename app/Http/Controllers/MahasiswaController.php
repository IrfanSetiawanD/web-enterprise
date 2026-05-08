<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// PERBAIKAN: Nama class harus sesuai dengan nama file Model kamu
use App\Models\MahasiswaModel;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan data mahasiswa di halaman Home.
     */
    public function index()
    {
        // PERBAIKAN: Panggil MahasiswaModel::get()
        $mahasiswa = MahasiswaModel::get();

        return view('home', compact('mahasiswa'));
    }

    /**
     * Menyimpan data mahasiswa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama_mahasiswa' => 'required',
            'jurusan' => 'required',
        ]);

        // PERBAIKAN: Panggil MahasiswaModel::create()
        MahasiswaModel::create([
            'nim'            => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'jurusan'        => $request->jurusan,
            'tempat_lahir'   => $request->tempat_lahir,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'alamat'         => $request->alamat,
            'no_hp'          => $request->no_hp,
        ]);

        Session::flash('message', 'Data Mahasiswa berhasil disimpan!');
        return redirect()->route('home');
    }
}
