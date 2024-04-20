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
        'barang_id',
        'barangkeluar_tanggal',
        'customer_id',
        'barangkeluar_jumlah',
        'barangkeluar_harga',
        'barangkeluar_ongkir',
        'barangkeluar_tax',
        'barangkeluar_subtotal',
        'barangkeluar_total',
        'users_id',
        'ekspedisi_id',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'barang_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function ekspedisi()
    {
        return $this->belongsTo(Ekspedisi::class, 'ekspedisi_id', 'ekspedisi_id');
    }

    public function updateStock()
    {
        $barang = $this->barang;
        $stok_awal = $barang->barang_stok;
        $total_keluar = BarangKeluar::where('barang_id', $this->barang_id)->sum('barangkeluar_jumlah');
        $barang->barang_stok = $stok_awal - $total_keluar;
        $barang->save();
    }
}
