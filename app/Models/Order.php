<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    public $timestamps = false;
    public function pelanggan()

{
    return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
}
}


