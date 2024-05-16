<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_barangkeluardetail';
    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'barangkeluar_id',
        'barang_id',
        'barangkeluar_jumlah',
        'barangkeluar_harga',
        'barangkeluar_subtotal',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'barang_id');
    }

    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class, 'barangkeluar_id', 'barangkeluar_id');
    }
}
