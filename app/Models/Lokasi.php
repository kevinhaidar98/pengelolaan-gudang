<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_lokasi','kapasitas','isi'];
    protected function alokasi(){
        return $this->belongsToMany('Apps\Models\Alokasi','alokasi','id_lokasi','id_barang');
    }
}
