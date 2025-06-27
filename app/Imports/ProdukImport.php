<?php

namespace App\Imports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\ToModel;

class ProdukImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Produk([
            //
            'id_kategori' => $row[0],
            'kode_produk' => $row[1],
            'nama_produk' => $row[2],
            'merk' => $row[3],
            'harga_beli' => $row[4],
            'diskon' => $row[5],
            'harga_jual' => $row[6],
            'stok' => $row[7]

        ]);
    }
}
