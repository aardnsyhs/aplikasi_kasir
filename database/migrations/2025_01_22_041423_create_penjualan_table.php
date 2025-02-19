<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('tanggal_penjualan');
            $table->decimal('total_harga', 10, 2);
            $table->decimal('nominal_bayar', 10, 2);
            $table->decimal('kembalian', 10, 2);
            $table->uuid('pelanggan_id')->nullable();
            $table->uuid('user_id');
            $table->timestamps();

            $table->foreign('pelanggan_id')->references('id')->on('pelanggan');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
