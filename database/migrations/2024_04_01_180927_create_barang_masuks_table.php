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
            $table->increments('barangmasuk_id');
            $table->string('barangmasuk_kode');
            $table->string('barang_id');
            $table->string('barangmasuk_tanggal');
            $table->integer('barangmasuk_jumlah');
            $table->string('users_id');
            $table->timestamps();
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
