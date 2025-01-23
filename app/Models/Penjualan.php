<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    /** @use HasFactory<\Database\Factories\PenjualanFactory> */
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'tanggal_penjualan',
        'total_harga',
        'pelanggan_id',
    ];

    public function pelanggan() {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function detailPenjualan() {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }
}
