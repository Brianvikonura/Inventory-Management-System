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
        Schema::create('tbl_ekspedisi', function (Blueprint $table) {
            $table->id('ekspedisi_id');
            $table->string('ekspedisi_nama');
            $table->string('ekspedisi_jenis');
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
        Schema::dropIfExists('tbl_ekspedisi');
    }
};
