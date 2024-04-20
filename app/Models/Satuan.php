<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $table = 'tbl_satuan';
    protected $primaryKey ='satuan_id';
    protected $fillable = [
       'satuan_nama',
       'satuan_keterangan',
        'users_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
