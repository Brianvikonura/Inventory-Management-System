<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = "tbl_barangmasuk";
    protected $primaryKey = 'barangmasuk_id';
    protected $fillable = [
        'barangmasuk_kode',
        'barang_kode',
        'barangmasuk_tanggal',
        'barangmasuk_jumlah',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_kode', 'barang_kode');
    }

    public function updateStock()
    {
        $barang = $this->barang;
        $total_masuk = BarangMasuk::where('barang_kode', $this->barang_kode)->sum('barangmasuk_jumlah');
        $barang->barang_stok = $total_masuk;
        $barang->save();
    }
}
