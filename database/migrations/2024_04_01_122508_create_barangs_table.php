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
            $table->id('barang_id');
            $table->unsignedBigInteger('jenisbarang_id');
            $table->unsignedBigInteger('satuan_id');
            $table->string('barang_kode');
            $table->string('barang_nama');
            $table->integer('barang_stok');
            $table->string('barang_gambar')->nullable();
            $table->unsignedBigInteger('users_id');
            $table->timestamps();
            $table->foreign('jenisbarang_id')->references('jenisbarang_id')->on('tbl_jenisbarang');
            $table->foreign('satuan_id')->references('satuan_id')->on('tbl_satuan');
            $table->foreign('users_id')->references('id')->on('users');
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
