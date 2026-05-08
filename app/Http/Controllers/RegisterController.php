<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\MailSend;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function actionregister(Request $request)
    {
        // Validasi dasar untuk memastikan email & username unik
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
        ]);

        $str = Str::random(100);

        // Membuat user baru
        $user = User::create([
            'name' => $request->username, // Mengisi kolom name agar dashboard tidak kosong
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'Guest',
            'verify_key' => $str,
            'active' => 0 // Set 0 karena harus verifikasi email dulu
        ]);

        // Menyiapkan data untuk dikirim ke MailSend
        $details = [
            'username' => $request->username,
            'role' => $user->role,
            'website' => 'SIMA Enterprise',
            'datetime' => now()->format('Y-m-d H:i:s'),
            // Menggunakan helper url() agar link otomatis lengkap dengan http:// atau https://
            'url' => url('/register/verify/' . $str)
        ];

        // Proses Pengiriman Email
        Mail::to($request->email)->send(new MailSend($details));

        Session::flash('message', 'Link verifikasi telah dikirim ke Email Anda. Silakan cek Inbox/Spam untuk mengaktifkan akun.');
        return redirect('register');
    }

    public function verify($verify_key)
    {
        // Mencari user berdasarkan verify_key
        $user = User::where('verify_key', $verify_key)->first();

        if ($user) {
            // Update status user menjadi aktif
            $user->update([
                'active' => 1,
                'email_verified_at' => now() // Standar Laravel untuk verifikasi email
            ]);

            return "Verifikasi Berhasil. Akun Anda sudah aktif. Silakan kembali ke halaman login.";
        } else {
            return "Key verifikasi tidak valid atau sudah kadaluwarsa!";
        }
    }
}
