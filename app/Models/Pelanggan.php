<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model 
{
    use HasFactory;
    
    protected $table = 'pelanggan';
    public $timestamps = false;

    protected $fillable = [
        'id_pelanggan', 'nama_pelanggan', 'email_pelanggan', 'password_pelanggan', 'alamat_pelanggan', 'notelp_pelanggan',
    ];

    public function getIdUserAttribute()
    {
        return $this->attributes['id_pelanggan'];
    }

    protected $rememberTokenName = 'remember_token';
}
