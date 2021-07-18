<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatKeluar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


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

    public function showRiwayatKeluarList(Request $request)
    {
        $selection = $request->keyword;
        if($selection){
            $riwayat = RiwayatKeluar::where('tanggal_keluar', 'LIKE', "%$selection%")->paginate(10);
        } else {
            $riwayat = RiwayatKeluar::paginate(10);
        }
        return view('', ['riwayat_masuk'=> $riwayat]);
    }

    public function createRiwayatKeluar(Request $request){
        $validate = Validator::make($request->all(), [
            'nama_barang'=>'required|min:5',
            'jumlah' => 'required',
            'tanggal_keluar'=>'required'
        ], [
            'nama_barang.required'=>'Nama barang harus diisi',
            'jumlah.required' => 'Jumlah harus diisi',
            'tanggal_keluar.required'=>''
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error','Semua field tidak boleh kosong');
        }else{
            $riwayat = new RiwayatKeluar();
            $riwayat->nama_barang = $request->nama_barang;
            $riwayat->jumlah = $request->jumlah;
            $riwayat->save();
            return redirect()->route('RiwayatKeluar.showRiwayatKeluarlist')->with('status', 'Sukses menambahkan data barang');
        }
    }
    
    public function editRiwayatKeluar($id){
        $riwayat = RiwayatKeluar::findOrFail($id);
        return view(' ', ['riwayat_masuk' => $riwayat]);
    }

    public function destroyRiwayatKeluar($id){
        $riwayat = RiwayatKeluar::findOrFail($id);
        $riwayat->delete();
        return redirect()->back()->with('status', 'Sukses menghapus data barang');
    }
}
