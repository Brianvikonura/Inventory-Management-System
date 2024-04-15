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
        'barang_id',
        'barangmasuk_tanggal',
        'barangmasuk_jumlah',
        'users_id',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'barang_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function updateStock()
    {
        $barang = $this->barang;
        $total_masuk = BarangMasuk::where('barang_id', $this->barang_id)->sum('barangmasuk_jumlah');
        $barang->barang_stok = $total_masuk;
        $barang->save();
    }
}
