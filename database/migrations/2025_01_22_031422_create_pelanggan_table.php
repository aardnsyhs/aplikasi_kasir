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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_pelanggan');
            $table->text('alamat');
            $table->string('nomor_telepon');
            $table->string('username')->unique();
            $table->enum('jenis_pelanggan', ['bukan_member', 'member_baru', 'member'])->default('bukan_member');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
