<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\RiwayatMasukController;
use App\Http\Controllers\RiwayatKeluarController;
use App\Http\Controllers\StoringController; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()->route('login');
});
Auth::routes(['register' => false]);
Route::group(['middleware'=>'auth'], function(){  
    Route::group(['middleware'=>'superadmin','prefix'=>'users'], function(){
        Route::get('/showuser',[UserController::class, 'showUserList'])->name('user.showuserlist');
        Route::get('/adduser',[UserController::class,'showUserForm'])->name('user.adduser');
        Route::post('/storeuser',[UserController::class,'createUser'])->name('user.createuser');
        Route::get('/edituser/{id}',[UserController::class,'editUser'])->name('user.edituser');
        Route::post('/updateuser/{id}',[UserController::class,'updateUser'])->name('user.updateuser');
        Route::get('/deleteuser/{id}',[UserController::class,'destroyUser'])->name('user.deleteuser');
    });
    Route::group(['middleware'=>'superadmin','prefix'=>'barang'], function(){
        Route::get('/showbarang',[BarangController::class, 'showBarangList'])->name('barang.showbaranglist');
        Route::get('/addbarang',[BarangController::class,'showBarangForm'])->name('barang.addbarang');
        Route::post('/storebarang',[BarangController::class,'createBarang'])->name('barang.createbarang');
        Route::get('/editbarang/{id}',[BarangController::class,'editBarang'])->name('barang.editbarang');
        Route::post('/updatebarang/{id}',[BarangController::class,'updateBarang'])->name('barang.updatebarang');
        Route::get('/deletebarang/{id}',[BarangController::class,'destroyBarang'])->name('barang.deletebarang');
    });
    Route::group(['middleware'=>'superadmin','prefix'=>'gudang'], function(){
        Route::get('/showgudang',[StoringController::class, 'showGudang'])->name('gudang.showgudang');
        Route::get('/showisigudang/{id}/ruang/{nama_letak}',[StoringController::class, 'showIsiGudang'])->name('gudang.showisigudang');
        Route::get('/showisigudang/{id}/ruang/{nama_letak}/addisigudang',[StoringController::class, 'addIsiGudang'])->name('gudang.addisigudang');
        Route::get('/barang/list',[StoringController::class,'getBarangList'])->name('gudang.baranglist');
        Route::post('/storeisigudang',[StoringController::class,'createIsiGudang'])->name('gudang.createisigudang');
        // Route::get('/addbarang',[BarangController::class,'showBarangForm'])->name('barang.addbarang');
        // Route::post('/storebarang',[BarangController::class,'createBarang'])->name('barang.createbarang');
        // Route::get('/editbarang/{id}',[BarangController::class,'editBarang'])->name('barang.editbarang');
        // Route::post('/updatebarang/{id}',[BarangController::class,'updateBarang'])->name('barang.updatebarang');
        // Route::get('/deletebarang/{id}',[BarangController::class,'destroyBarang'])->name('barang.deletebarang');
    });
    Route::group(['middleware'=>'superadmin','prefix'=>'transaksi-masuk'], function(){
        Route::get('/showtrans',[RiwayatMasukController::class, 'showTransaksiMasukList'])->name('transaksimasuk.showtransaksimasuk');
        Route::get('/showtransate',[RiwayatMasukController::class, 'showTransaksiMasukList'])->name('transaksimasuk.showtransaksimasukdate');
        Route::get('/showformtransmasuk',[RiwayatMasukController::class, 'showFormTransaksiMasuk'])->name('transaksimasuk.showformtransaksimasuk');
        Route::post('/createtransaksimasuk',[RiwayatMasukController::class,'createRiwayatMasuk'])->name('transaksimasuk.createtransaksimasuk');
        // Route::get('/showisigudang/{id}/ruang/{nama_letak}',[StoringController::class, 'showIsiGudang'])->name('gudang.showisigudang');
        // Route::get('/showisigudang/{id}/ruang/{nama_letak}/addisigudang',[StoringController::class, 'addIsiGudang'])->name('gudang.addisigudang');
        // Route::get('/barang/list',[StoringController::class,'getBarangList'])->name('gudang.baranglist');
        // Route::post('/storeisigudang',[StoringController::class,'createIsiGudang'])->name('gudang.createisigudang');
        // Route::get('/addbarang',[BarangController::class,'showBarangForm'])->name('barang.addbarang');
        
        // Route::get('/editbarang/{id}',[BarangController::class,'editBarang'])->name('barang.editbarang');
        // Route::post('/updatebarang/{id}',[BarangController::class,'updateBarang'])->name('barang.updatebarang');
        // Route::get('/deletebarang/{id}',[BarangController::class,'destroyBarang'])->name('barang.deletebarang');
    });
    Route::group(['middleware'=>'superadmin','prefix'=>'transaksi-keluar'], function(){
        Route::get('/showtrans',[RiwayatKeluarController::class, 'showTransaksiKeluarList'])->name('transaksikeluar.showtransaksikeluar');
        Route::get('/showtransdate',[RiwayatKeluarController::class, 'showTransaksiKeluarList'])->name('transaksikeluar.showtransaksikeluardate');
        // Route::get('/showisigudang/{id}/ruang/{nama_letak}',[StoringController::class, 'showIsiGudang'])->name('gudang.showisigudang');
        // Route::get('/showisigudang/{id}/ruang/{nama_letak}/addisigudang',[StoringController::class, 'addIsiGudang'])->name('gudang.addisigudang');
        // Route::get('/barang/list',[StoringController::class,'getBarangList'])->name('gudang.baranglist');
        // Route::post('/storeisigudang',[StoringController::class,'createIsiGudang'])->name('gudang.createisigudang');
        // Route::get('/addbarang',[BarangController::class,'showBarangForm'])->name('barang.addbarang');
        // Route::post('/storebarang',[BarangController::class,'createBarang'])->name('barang.createbarang');
        // Route::get('/editbarang/{id}',[BarangController::class,'editBarang'])->name('barang.editbarang');
        // Route::post('/updatebarang/{id}',[BarangController::class,'updateBarang'])->name('barang.updatebarang');
        // Route::get('/deletebarang/{id}',[BarangController::class,'destroyBarang'])->name('barang.deletebarang');
    });
});


