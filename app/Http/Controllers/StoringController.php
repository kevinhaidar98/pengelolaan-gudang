<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;

class StoringController extends Controller
{
    public function __construct()
    {
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            die("Database tidak terhubung");
        }
    }
    public function showGudang(Request $request)
    {
        $lokasi = Lokasi::get();
        
        //dd($lokasi);
        return view('functions.gudang.dashboard', ['lokasi' => $lokasi]);
    }
    public function showIsiGudang(Request $request)
    {
        // if($selection){
        //     $riwayat = RiwayatMasuk::where('tanggal_masuk', 'LIKE', "%$selection%")->paginate(10);
        // } else {
        $lokasi = Lokasi::findOrFail($request->id);
        $barangs = [];
        foreach ($lokasi->barang as $barang) {
            $barang['jumlah'] = $barang->pivot->jumlah;
            array_push($barangs,$barang);
        }
        //dd($barangs);
        return view('functions.gudang.isigudang', ['items' => $barangs]);
        // functions.gudang.dashboard
        // foreach($lokasi->barang as $barang){
        //     echo $barang->id_barang;
        //     echo $barang->pivot->jumlah;
        //     echo $barang->pivot->created_at;
        // }

        //dd($barangs);
        //$riwayat = Lokasi::paginate(10);
        // }
        
    }
    public function addIsiGudang(Request $request)
    {
        return view('functions.gudang.addisigudang');
    }
}
