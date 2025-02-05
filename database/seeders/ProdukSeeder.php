<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/produk.json'));
        $produk = json_decode($json, true);

        foreach ($produk as $item) {
            DB::table('produk')->insert([
                'id' => Str::uuid(),
                'nama_produk' => $item['nama_produk'],
                'harga' => $item['harga'],
                'stok' => $item['stok'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
