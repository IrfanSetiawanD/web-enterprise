<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaModel;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Admin melihat semua data, Mahasiswa hanya melihat miliknya sendiri
        if (Auth::user()->role == 'Admin') {
            $mahasiswa = MahasiswaModel::all();
        } else {
            // Mengambil data berdasarkan NIM yang tersimpan di sesi user yang login
            $mahasiswa = MahasiswaModel::where('nim', Auth::user()->nim)->get();
        }

        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Menyimpan data mahasiswa baru sekaligus membuat akun login otomatis.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim'            => 'required|unique:mahasiswa,nim',
            'nama_mahasiswa' => 'required',
            'jurusan'        => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required|date',
        ]);

        // 1. Simpan ke tabel mahasiswa
        MahasiswaModel::create([
            'nim'            => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'jurusan'        => $request->jurusan,
            'tempat_lahir'   => $request->tempat_lahir,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'alamat'         => $request->alamat,
            'no_hp'          => $request->no_hp,
            'status'         => 'Non-Active',
        ]);

        // 2. Buat password default dari tanggal lahir (format: ddmmyyyy)
        $passwordBaru = Carbon::parse($request->tanggal_lahir)->format('dmY');

        // 3. Simpan ke tabel users agar bisa login
        User::create([
            'name'     => $request->nama_mahasiswa,
            'username' => $request->nama_mahasiswa, // Mengisi kolom username sesuai database Anda
            'email'    => $request->nim . '@mail.com', // NIM digunakan sebagai email login
            'password' => Hash::make($passwordBaru),
            'role'     => 'Mahasiswa',
            'nim'      => $request->nim,
            'active'   => 1, // Memberikan status aktif pada akun baru
        ]);

        Session::flash('message', 'Data Berhasil Disimpan! Password Login: ' . $passwordBaru);
        return redirect()->route('home');
    }

    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->route('home')->with('message', 'ID Mahasiswa tidak valid.');
        }

        $mhs = MahasiswaModel::findOrFail($id);

        // Proteksi: Mahasiswa dilarang mengedit profil orang lain via URL
        if (Auth::user()->role !== 'Admin' && Auth::user()->nim !== $mhs->nim) {
            return redirect('home')->with('message', 'Anda tidak memiliki akses ke data ini.');
        }

        return view('mahasiswa.edit', compact('mhs'));
    }

    /**
     * Memperbarui data profil dan melakukan sinkronisasi ke akun user jika NIM berubah.
     */
    public function update(Request $request, $id)
    {
        $mhs = MahasiswaModel::findOrFail($id);
        $nimLama = $mhs->nim; // Simpan NIM lama sebelum diupdate

        // Proteksi akses
        if (Auth::user()->role !== 'Admin' && Auth::user()->nim !== $mhs->nim) {
            return redirect('home')->with('error', 'Akses ditolak.');
        }

        // Validasi
        $rules = [
            'nama_mahasiswa' => 'required',
            'jurusan'        => 'required',
        ];

        if (Auth::user()->role === 'Admin') {
            $rules['nim'] = 'required|unique:mahasiswa,nim,' . $id . ',id_mahasiswa';
        }

        $request->validate($rules);

        // Data untuk update tabel Mahasiswa
        $dataUpdate = [
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'jurusan'        => $request->jurusan,
            'tempat_lahir'   => $request->tempat_lahir,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'no_hp'          => $request->no_hp,
            'alamat'         => $request->alamat,
        ];

        if (Auth::user()->role === 'Admin') {
            $dataUpdate['nim'] = $request->nim;

            /**
             * SINKRONISASI KE TABEL USERS
             * Karena tabel 'users' tidak punya kolom 'nim', kita cari berdasarkan email lama.
             * Format email akun mahasiswa Anda adalah: NIM_LAMA@mail.com
             */
            $userAccount = User::where('email', $nimLama . '@mail.com')->first();

            if ($userAccount) {
                $userAccount->update([
                    'name'     => $request->nama_mahasiswa,
                    'username' => $request->nama_mahasiswa,
                    'email'    => $request->nim . '@mail.com' // Update ke email berbasis NIM baru
                ]);
            }
        }

        $mhs->update($dataUpdate);

        return redirect()->route('home')->with('message', 'Profil berhasil diperbarui!');
    }
}
