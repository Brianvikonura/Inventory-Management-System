<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = "tbl_barangkeluar";
    protected $primaryKey = 'barangkeluar_id';
    protected $fillable = [
        'barangkeluar_kode',
        'barang_kode',
        'barangkeluar_tanggal',
        'customer_id',
        'barangkeluar_jumlah',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_kode', 'barang_kode');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function updateStock()
    {
        $barang = $this->barang;
        $stok_awal = $barang->barang_stok;
        $total_keluar = BarangKeluar::where('barang_kode', $this->barang_kode)->sum('barangkeluar_jumlah');
        $barang->barang_stok = $stok_awal - $total_keluar;
        $barang->save();
    }
}
