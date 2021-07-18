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
    public function riwayatMasuk(){
        return $this->hasMany('Apps\Models\RiwayatMasuk');
    }
    public function riwayatKeluar(){
        return $this->hasMany('Apps\Models\RiwayatKeluar');
    }
    public function role(){
        return $this->belongsTo('Apps\Models\Role');
    }

}
