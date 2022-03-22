<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Lokasi;

class RiwayatKeluarController extends Controller
{
    public function __construct()
    {
        try{
            DB::connection()->getPdo();
        } catch (\Exception $e){
            die("Database tidak terhubung");
        }
    }

    public function showTransaksiKeluarList(Request $request)
    {
        //menampilkan list transaksi barang keluar
        $selection = $request->keyword;
        $tanggal = $request->input('reservationdate');
        if($tanggal){
            $transaksi = DB::table('transaksi')
            ->join('users','users.id','=','transaksi.id_user')
            ->join('barang','barang.id','=','transaksi.id_barang')
            ->select('transaksi.*', 'users.nama as nama_user','barang.nama_barang as nama_barang')
            ->where('tanggal','=',$tanggal)
            ->where('status','=','1')
            ->orderByDesc('tanggal')
            ->paginate(10);
        }else{
            $transaksi = DB::table('transaksi')
            ->join('users','users.id','=','transaksi.id_user')
            ->join('barang','barang.id','=','transaksi.id_barang')
            ->select('transaksi.*', 'users.nama as nama_user','barang.nama_barang as nama_barang')
            ->where('status','=','1')
            ->orderByDesc('tanggal')
            ->paginate(10);
        }
        return view('functions.transaksiKeluar.dashboard', ['transaksi'=> $transaksi]);
    }

    public function showFormTransaksiKeluar(Request $request){
        //menampilkan halaman form tambah transaksi keluar
        return view('functions.transaksiKeluar.createTransaksiKeluar');
    }

    public function createRiwayatKeluar(Request $request){
        //menyimpan hasil masukan pengguna ke dalam database
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
            $status = 1;
            $klien = $request->klien;
            $tanggal = $request->reservationdate;
            $user->transaksi()->attach($barang,['kode_transaksi' => $kode, 'jumlah' => $jumlah, 'status' => $status, 'klien' => $klien, 'tanggal' => $tanggal]);
            return redirect()->route('transaksikeluar.showtransaksikeluar')->with('status', 'Sukses menambahkan barang');
        }
    }
    
    public function prosesKeluar($id){
        //mengubah status transaksi keluar
        $riwayat = DB::table('transaksi')->where('id',$id)->update(['is_process'=>1]);
        return redirect()->back();
    }

    public function destroyKeluar($id){
        //menghapus transaksi keluar
        $riwayat = DB::table('transaksi')->where('id',$id);
        $riwayat->delete();
        return redirect()->back()->with('status', 'Sukses menghapus Transaksi Keluar');
    }
}
