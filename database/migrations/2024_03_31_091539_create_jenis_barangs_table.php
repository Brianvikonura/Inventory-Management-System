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
        Schema::create('tbl_jenisbarang', function (Blueprint $table) {
            $table->id('jenisbarang_id');
            $table->string('jenisbarang_nama');
            $table->string('jenisbarang_keterangan')->nullable();
            $table->unsignedBigInteger('users_id');
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_jenisbarang');
    }
};
