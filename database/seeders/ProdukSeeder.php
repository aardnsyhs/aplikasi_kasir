<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 100; $i++) {
            $data[] = [
                'nama_produk' => 'Produk ' . $i,
                'harga' => rand(1000, 1000000) / 100,
                'stok' => rand(1, 1000),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('produk')->insert($data);
    }
}
