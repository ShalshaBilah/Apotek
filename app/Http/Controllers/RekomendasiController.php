<?php

namespace App\Http\Controllers;

use App\Models\Prodak;
use Illuminate\Http\Request;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;

class RekomendasiController extends Controller
{
    public function preferensi(Request $request)
    {

        return view('frontend.preferensi');
    }

    public function savePreferences(Request $request)
    {

     
        $validated = $request->validate([
            'kategori' => 'required|string|max:255',
            'gejala' => 'required|string|max:255',
            'usia' => 'required|string|max:255'

        ]);

        UserPreference::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        

        return redirect()->route('rekomendasi')
            ->with('success', 'Preferensi berhasil disimpan!');
    }
    public function contentBasedFiltering()
{
    $user = Auth::user();
    $preferences = UserPreference::where('user_id', $user->id)->first();

    // Jika tidak ada preferensi pengguna, tidak menampilkan produk
    if (!$preferences) {
        return view('frontend.rekomendasi', [
            'recommendedProducts' => collect(), // Kirim koleksi kosong
            'preferences' => null
        ]);
    }

    // Ambil semua produk
    $allProducts = Prodak::all();

    // Inisialisasi bobot fitur
    $weights = [
        'kategori' => 0.38,
        'gejala' => 0.31,
        'usia' => 0.31,
    ];

    // Hitung skor similarity
    $scoredProducts = $allProducts->map(function ($product) use ($preferences, $weights) {
        $score = 0;

        if ($product->kategori === $preferences->kategori) {
            $score += $weights['kategori'];
        }

        if ($product->gejala === $preferences->gejala) {
            $score += $weights['gejala'];
        }

        if ($product->usia == $preferences->usia) {
            $score += $weights['usia'];
        }

        $product->score = $score;
        return $product;
    });

    // **FILTER: Hanya tampilkan produk dengan skor lebih dari 0**
    $filteredProducts = $scoredProducts->filter(function ($product) {
        return $product->score > 0;
    })->sortByDesc('score')->values()
    ->take(1); // Urutkan dari skor tertinggi

    return view('frontend.rekomendasi', [
        'recommendedProducts' => $filteredProducts,
        'preferences' => $preferences
    ]);
}

}

