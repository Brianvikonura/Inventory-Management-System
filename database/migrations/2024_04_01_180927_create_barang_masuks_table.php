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
        Schema::create('tbl_barangmasuk', function (Blueprint $table) {
            $table->id('barangmasuk_id');
            $table->string('barangmasuk_kode');
            $table->unsignedBigInteger('barang_id');
            $table->string('barangmasuk_tanggal');
            $table->integer('barangmasuk_jumlah');
            $table->unsignedBigInteger('users_id');
            $table->timestamps();
            $table->foreign('barang_id')->references('barang_id')->on('tbl_barang');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_barangmasuk');
    }
};
