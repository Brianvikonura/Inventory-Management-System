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
        Schema::create('tbl_barang', function (Blueprint $table) {
            $table->increments('barang_id');
            $table->string('jenisbarang_id');
            $table->string('satuan_id');
            $table->string('barang_kode');
            $table->string('barang_nama');
            $table->integer('barang_harga');
            $table->integer('barang_stok');
            $table->string('barang_gambar')->nullable();
            $table->string('users_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_barang');
    }
};
