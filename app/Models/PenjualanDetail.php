<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;
    protected $table = 'penjualan_detail';
    protected $primaryKey = 'id_penjualan_detail';
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function product()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function prodak()
    {
        return $this->belongsTo(Prodak::class, 'id');
    }
}
