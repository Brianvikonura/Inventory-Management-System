<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'tbl_barangkeluar';
    protected $primaryKey = 'barangkeluar_id';
    protected $fillable = [
        'barangkeluar_kode',
        'barangkeluar_tanggal',
        'customer_id',
        'barangkeluar_ongkir',
        'barangkeluar_total',
        'users_id',
        'ekspedisi_id',
    ];

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

    public function details()
    {
        return $this->hasMany(BarangKeluarDetail::class, 'barangkeluar_id', 'barangkeluar_id');
    }

    public function updateStock($barang_ids, $jumlah_keluar)
    {
        foreach ($barang_ids as $index => $barang_id) {
            $barang = Barang::find($barang_id);
            $stok_awal = $barang->barang_stok;
            $jumlah_keluar_barang = $jumlah_keluar[$index];
            $barang->barang_stok = $stok_awal - $jumlah_keluar_barang;
            $barang->save();
        }
    }
}
