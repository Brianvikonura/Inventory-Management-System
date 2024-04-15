<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class JenisBarang extends Model
{
    use HasFactory;

    protected $table = 'tbl_jenisbarang';
    protected $primaryKey = 'jenisbarang_id';
    protected $fillable = [
        'jenisbarang_nama',
        'jenisbarang_slug',
        'jenisbarang_keterangan',
        'users_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
