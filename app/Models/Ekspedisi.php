<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    use HasFactory;
    protected $table = "tbl_ekspedisi";
    protected $primaryKey = 'ekspedisi_id';
    protected $fillable = [
        'ekspedisi_nama',
        'ekspedisi_jenis',
        'users_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function barangkeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'barangkeluar_id', 'barangkeluar_id');
    }
}
