<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('penjualan_id');
            $table->uuid('produk_id');
            $table->integer('jumlah_produk');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();

            $table->foreign('penjualan_id')->references('id')->on('penjualan');
            $table->foreign('produk_id')->references('id')->on('produk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};
