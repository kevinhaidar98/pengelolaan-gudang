<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = "barang";
    protected $primaryKey = "id";
    //protected $fillable = "nama_barang";
    public function lokasi()
    {
        return $this->belongsToMany(Lokasi::class, 'lokasi_barang', 'id_barang', 'id_lokasi')
            ->withTimestamps()
            ->withPivot(['jumlah']);
    }
    public function user()
    {
        return $this->belongsToMany(User::class, 'transaksi', 'id_barang', 'id_user')
            ->withTimestamps()
            ->withPivot(['kode_transaksi', 'jumlah', 'status', 'is_process', 'klien', 'tanggal']);
    }
}
