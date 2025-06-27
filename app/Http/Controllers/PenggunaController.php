<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function user(Request $request)
    {
        return view('pengguna.index');
    }
    public function about(Request $request)
    {

        return view('pengguna.about');
    }
    public function layanan(Request $request)
    {

        return view('pengguna.layanan');
    }

    public function galeri(Request $request)
    {

        return view('pengguna.galeri');
    }

    public function kontak(Request $request)
    {

        return view('pengguna.kontak');
    }

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $pengguna = Pengguna::where('name', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $pengguna = Pengguna::paginate(5);
        }
        return view('pengguna.pengguna', compact('pengguna'));
    }
}
