<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatMasuk extends Model
{
    use HasFactory;
    protected $table = 'riwayat_masuk';
    protected $primaryKey = 'id';
    protected $fillable = ['id_user','id_barang','kode_transaksi','jumlah','tanggal_masuk'];

}
