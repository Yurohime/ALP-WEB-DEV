<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public $timestamps = false;
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'nama_produk', 
        'deskripsi', 
        'harga_beli', 
        'stok', 
        'main_gambar', 
        'sub_gambar1', 
        'sub_gambar2', 
        'sub_gambar3'
    ];

    // Define a getter method to access the primary key value
    public function getIdProdukAttribute()
    {
        return $this->attributes['id_produk'];
    }
}
