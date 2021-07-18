<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table="barang";
    protected $primaryKey = "id";

    public function alokasi(){
        return $this->belongsToMany('App\Models\Alokasi','alokasi','id_barang','id_lokasi');
    }
}
