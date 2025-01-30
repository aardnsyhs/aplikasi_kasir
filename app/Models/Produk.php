<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'produk';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
        'gambar'
    ];

    public function detailPenjualan() {
        return $this->hasMany(DetailPenjualan::class, 'produk_id');
    }
}
