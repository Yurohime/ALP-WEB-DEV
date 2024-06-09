<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'transaksi_detail';


    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaksi');
    }
}
