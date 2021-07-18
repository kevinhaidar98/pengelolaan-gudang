<?php

namespace App\Http\Controllers;

use App\Models\RiwayatMasuk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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

    public function showRiwayatMasukList(Request $request)
    {
        $selection = $request->keyword;
        if($selection){
            $riwayat = RiwayatMasuk::where('tanggal_masuk', 'LIKE', "%$selection%")->paginate(10);
        } else {
            $riwayat = RiwayatMasuk::paginate(10);
        }
        return view('', ['riwayat_masuk'=> $riwayat]);
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
