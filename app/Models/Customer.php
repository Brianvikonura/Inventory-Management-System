<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = "tbl_customer";
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'customer_nama',
        'customer_slug',
        'customer_alamat',
        'customer_notelp',
        'users_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
