<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\User;

class RiwayatMasukController extends Controller
{
    public function __construct()
    {
        try{
            DB::connection()->getPdo();
        } catch (\Exception $e){
            die("Database tidak terhubung");
        }
    }

    public function showTransaksiMasukList(Request $request)
    {
        //Menampilkan list barang masuk
        $tanggal = $request->input('reservationdate');
        if($tanggal){
            $transaksi = DB::table('transaksi')
            ->join('users','users.id','=','transaksi.id_user')
            ->join('barang','barang.id','=','transaksi.id_barang')
            ->select('transaksi.*', 'users.nama as nama_user','barang.nama_barang as nama_barang')
            ->where('tanggal','=',$tanggal)
            ->where('status','=','0')
            ->orderByDesc('tanggal')
            ->get();
        }else{
            $transaksi = DB::table('transaksi')
            ->join('users','users.id','=','transaksi.id_user')
            ->join('barang','barang.id','=','transaksi.id_barang')
            ->select('transaksi.*', 'users.nama as nama_user','barang.nama_barang as nama_barang')
            ->where('status','=','0')
            ->orderByDesc('tanggal')
            ->get();
        }
        return view('functions.transaksiMasuk.dashboard', ['transaksi'=> $transaksi]);
    }
    public function showFormTransaksiMasuk(Request $request){
        //menampilkan halaman form tambah transaksi masuk
        return view('functions.transaksiMasuk.createTransaksiMasuk');
    }

    public function createRiwayatMasuk(Request $request){
        //menyimpan hasil masukan pengguna kedalam database
        $validate = Validator::make($request->all(), [
            'barang'=>'required',
            'jumlah' => 'required',
            'klien'=>'required',
            'reservationdate'=>'required'
        ], [
            'barang.required'=>'Pilih Barang!',
            'jumlah.required' => 'Jumlah harus diisi',
            'klien.required' => 'Klien harus diisi',
            'reservationdate.required' => 'Tanggal harus diisi'
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error','Semua field tidak boleh kosong');
        }else{
            $user = User::findOrFail($request->id_user);
            $kode = mt_rand(0,10000000000);
            $barang = $request->barang;
            $jumlah = $request->jumlah;
            $klien = $request->klien;
            $tanggal = $request->reservationdate;
            $user->transaksi()->attach($barang,['kode_transaksi' => $kode, 'jumlah' => $jumlah, 'klien' => $klien, 'tanggal' => $tanggal]);
            return redirect()->route('transaksimasuk.showtransaksimasuk')->with('status', 'Sukses menambahkan transaksi barang masuk');
        }
    }

    public function prosesMasuk($id){
        //mengubah status transaksi
        $riwayat = DB::table('transaksi')->where('id',$id)->update(['is_process'=>1]);
        return redirect()->back();
    }

    public function destroyMasuk($id){
        //menghapus transaksi
        $riwayat = DB::table('transaksi')->where('id',$id);
        $riwayat->delete();
        return redirect()->back()->with('status', 'Sukses menghapus Transaksi Masuk');
    }
}
