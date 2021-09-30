<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'id_role','username','password','nama','telepon','alamat'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function transaksi(){
        return $this->belongsToMany(Barang::class,'transaksi','id_user','id_barang')
        ->withTimestamps()
        ->withPivot(['kode_transaksi','jumlah','status','is_process','klien','tanggal']);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }

}
