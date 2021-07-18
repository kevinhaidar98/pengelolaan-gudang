<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alokasi extends Model
{
    use HasFactory;
    protected $table = 'alokasi';
    protected $fillable = ['id_barang', 'id_lokasi'];
    protected function barang(){
        return $this->belongsToMany('App\Models\Barang');
    }
    protected function lokasi(){
        return $this->belongsToMany('App\Models\Lokasi');
    }
}
