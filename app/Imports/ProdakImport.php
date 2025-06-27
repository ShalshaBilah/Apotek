<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\Prodak;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Storage;

class ProdakImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Periksa apakah produk sudah ada berdasarkan nama
        $existingProdak = Prodak::where('nama', $row['nama'])->first();

        if ($existingProdak) {
            // Jika produk sudah ada, return null untuk menghindari duplikat
            return null;
        }

        // Jika produk belum ada, buat produk baru
        return new Prodak([
            'nama' => $row['nama'] ?? 'Nama Tidak Diketahui',
            'kategori' => $row['kategori'] ?? 'Kategori Tidak Diketahui',
            'gejala' => $row['gejala'] ?? 'Gejala Tidak Diketahui',
            'usia' => $row['usia'] ?? 'Usia Tidak Diketahui',
            'harga' => $row['harga'] ?? 0,
            'deskripsi' => $row['deskripsi'] ?? 'Deskripsi Tidak Diketahui',
            'manfaat' => $row['manfaat'] ?? 'Manfaat Tidak Diketahui',
            'dosis' => $row['dosis'] ?? 'Dosis Tidak Diketahui',
            'aturan_pakai' => $row['aturan_pakai'] ?? 'Aturan Pakai Tidak Diketahui',
            'logo' => $row['logo'] ?? 'default_logo.jpg',
        ]);
    }

    /**
     * Menyimpan gambar ke folder 'logos' dan mengembalikan path-nya.
     *
     * @param string $imageName
     * @return string
     */
    private function storeImage($imageName)
    {
        // Misalnya gambar sudah ada di folder 'public/uploads/logos'
        // Salin gambar ke folder 'public/logos'
        $imagePath = 'logos/' . $imageName;
        $imageFullPath = public_path('uploads/logos/' . $imageName);

        // Pastikan file gambar ada
        if (file_exists($imageFullPath)) {
            $newImagePath = 'logos/' . $imageName;
            // Salin gambar
            Storage::disk('public')->put($newImagePath, file_get_contents($imageFullPath));
            return $newImagePath; // Mengembalikan path relatif gambar
        }

        return null; // Kembalikan null jika gambar tidak ditemukan
    }
}
