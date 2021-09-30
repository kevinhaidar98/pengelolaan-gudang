<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $primaryKey = 'id';
    //protected $fillable = ['nama_lokasi','kapasitas'];
    public function barang(){
        return $this->belongsToMany(Barang::class,'lokasi_barang','id_lokasi','id_barang')
        ->withTimestamps()
        ->withPivot(['jumlah']);;
    }
}
