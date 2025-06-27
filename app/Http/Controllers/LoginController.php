<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function loginuser()
    {
        return view('loginuser');
    }

    public function loginproses(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('pengguna')->attempt($credentials)) {
            return redirect('/telu'); // Redirect ke halaman setelah login berhasil
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return redirect()->route('loginuser')->withErrors([
            'login' => 'Email atau password salah!'
        ])->withInput(); // Menyimpan input email agar tidak perlu mengetik ulang
    }


    public function registerusers()
    {
        return view('registeruser');
    }

    public function registeruser(Request $request)
    {
        // Simpan pengguna baru
        Pengguna::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);

        return redirect('/loginuser')->with('success', 'Registrasi berhasil, silakan login.');
    }


    public function logoutuser()
    {
        Auth::guard('pengguna')->logout();
        return redirect('/loginuser');
    }
}
