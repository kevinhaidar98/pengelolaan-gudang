<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Lokasi;

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
        $selection = $request->keyword;
        $transaksi = DB::table('transaksi')
                    ->join('users','users.id','=','transaksi.id_user')
                    ->join('barang','barang.id','=','transaksi.id_barang')
                    ->select('transaksi.*', 'users.nama as nama_user','barang.nama_barang as nama_barang')
                    ->where('status','=','0')
                    ->orderByDesc('tanggal')
                    ->paginate(10);

        //$barang = Barang::all();
        // // if($selection){
        // //     $riwayat = RiwayatMasuk::where('tanggal_masuk', 'LIKE', "%$selection%")->paginate(10);
        // // } else {
        //     $lokasi = Lokasi::with('barang')->find(1);
        //     $barangs = [];
        //     foreach($lokasi->barang as $barang){
        //         $barangs[] = $barang;
        //     }
            
        //     // foreach($lokasi->barang as $barang){
        //     //     echo $barang->id_barang;
        //     //     echo $barang->pivot->jumlah;
        //     //     echo $barang->pivot->created_at;
        //     // }
            
        //      dd($barangs);
        //     //$riwayat = Lokasi::paginate(10);
        // // }
        //dd($transaksi);
        return view('functions.transaksiMasuk.dashboard', ['transaksi'=> $transaksi]);
    }

    public function createRiwayatMasuk(Request $request){
        $validate = Validator::make($request->all(), [
            'nama_barang'=>'required|min:5',
            'jumlah' => 'required',
            'tanggal_masuk'=>'required'
        ], [
            'nama_barang.required'=>'Nama barang harus diisi',
            'jumlah.required' => 'Jumlah harus diisi',
            'tanggal_masuk.required'=>''
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error','Semua field tidak boleh kosong');
        }else{
            $riwayat = new RiwayatMasuk();
            $riwayat->nama_barang = $request->nama_barang;
            $riwayat->jumlah = $request->jumlah;
            $riwayat->save();
            return redirect()->route('riwayatMasuk.showRiwayatMasuklist')->with('status', 'Sukses menambahkan data barang');
        }
    }
    
    public function editRiwayat($id){
        $riwayat = RiwayatMasuk::findOrFail($id);
        return view(' ', ['riwayat_masuk' => $riwayat]);
    }

    public function destroyRiwayat($id){
        $riwayat = RiwayatMasuk::findOrFail($id);
        $riwayat->delete();
        return redirect()->back()->with('status', 'Sukses menghapus data barang');
    }
}
