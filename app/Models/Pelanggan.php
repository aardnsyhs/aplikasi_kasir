<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    /** @use HasFactory<\Database\Factories\PelangganFactory> */
    use HasFactory, HasUuids;

    protected $table = 'pelanggan';
    protected $keyType = 'string';
    public $incrementing = false;


    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'nomor_telepon',
        'jenis_pelanggan'
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'pelanggan_id');
    }
}
