<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id_member'); // Sesuaikan nama kolom foreign key dan primary key
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'id_member', 'id'); // Sesuaikan dengan kolom foreign key 'id_user'
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_member', 'id');
    }

    public function detail()
    {
        return $this->hasMany(PenjualanDetail::class, 'id_penjualan', 'id_penjualan');
    }
    public function members()
    {
        return $this->belongsTo(User::class, 'id_member');
    }

}
