<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaksi extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'transaksi';

    protected $primaryKey = 'id_transaksi';

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_pelanggan');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'id_transaksi');
    }
}
