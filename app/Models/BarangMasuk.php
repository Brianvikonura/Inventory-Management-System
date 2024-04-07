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
        'customer_id',
        'barangmasuk_tanggal',
        'barangmasuk_jumlah',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_kode', 'barang_kode');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
