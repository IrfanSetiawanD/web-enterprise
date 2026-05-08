<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        // Jika sudah login, langsung lempar ke home
        if (Auth::check()) {
            return redirect('home');
        } else {
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        // Mengambil data input
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        // Proses Autentikasi
        if (Auth::attempt($credentials)) {
            // Jika sukses, buat ulang session untuk keamanan (fix fixation attack)
            $request->session()->regenerate();
            return redirect()->intended('home');
        } else {
            // Jika gagal, kirim pesan error
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
    }

    public function actionlogout(Request $request)
    {
        Auth::logout();

        // Menghancurkan session agar tidak bisa digunakan kembali
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
