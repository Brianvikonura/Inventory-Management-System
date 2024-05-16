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
        Schema::create('tbl_barangkeluardetail', function (Blueprint $table) {
            $table->id('detail_id');
            $table->unsignedBigInteger('barangkeluar_id');
            $table->unsignedBigInteger('barang_id');
            $table->integer('barangkeluar_jumlah');
            $table->integer('barangkeluar_harga');
            $table->integer('barangkeluar_subtotal');
            $table->timestamps();
            $table->foreign('barangkeluar_id')->references('barangkeluar_id')->on('tbl_barangkeluar');
            $table->foreign('barang_id')->references('barang_id')->on('tbl_barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_barangkeluardetail');
    }
};
