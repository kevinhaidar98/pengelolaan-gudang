<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKeluar extends Model
{
    use HasFactory;
    protected $table = 'riwayat_keluar';

    protected $fillable = ['id_barang','id_user','kode_transaksi','jumlah','tujuan','tanggal_keluar'];

}
