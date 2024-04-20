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
        Schema::create('tbl_barangkeluar', function (Blueprint $table) {
            $table->increments('barangkeluar_id');
            $table->string('barangkeluar_kode');
            $table->string('barang_id');
            $table->string('barangkeluar_tanggal');
            $table->string('customer_id');
            $table->integer('barangkeluar_jumlah');
            $table->integer('barangkeluar_harga');
            $table->integer('barangkeluar_ongkir');
            $table->integer('barangkeluar_tax');
            $table->integer('barangkeluar_subtotal');
            $table->integer('barangkeluar_total');
            $table->string('users_id');
            $table->string('ekspedisi_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_barangkeluar');
    }
};
