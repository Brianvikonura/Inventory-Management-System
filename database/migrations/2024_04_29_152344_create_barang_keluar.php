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
            $table->id('barangkeluar_id');
            $table->string('barangkeluar_kode');
            $table->date('barangkeluar_tanggal');
            $table->unsignedBigInteger('customer_id');
            $table->integer('barangkeluar_ongkir');
            $table->integer('barangkeluar_total');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('ekspedisi_id');
            $table->timestamps();
            $table->foreign('customer_id')->references('customer_id')->on('tbl_customer');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('ekspedisi_id')->references('ekspedisi_id')->on('tbl_ekspedisi');
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
