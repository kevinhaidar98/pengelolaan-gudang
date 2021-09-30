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
        $lokasi = Lokasi::with('barang')->get();
        
        dd($lokasi);
        return view('functions.gudang.dashboard', ['lokasi' => $lokasi]);
    }
    public function showIsiGudang(Request $request)
    {
        $selection = $request->keyword;
        // if($selection){
        //     $riwayat = RiwayatMasuk::where('tanggal_masuk', 'LIKE', "%$selection%")->paginate(10);
        // } else {
        $lokasi = Lokasi::with('barang')->find(1);
        $barangs = [];
        foreach ($lokasi->barang as $barang) {
            $barangs[] = $barang;
        }

        // foreach($lokasi->barang as $barang){
        //     echo $barang->id_barang;
        //     echo $barang->pivot->jumlah;
        //     echo $barang->pivot->created_at;
        // }

        //dd($barangs);
        //$riwayat = Lokasi::paginate(10);
        // }
        return view('functions.gudang.dashboard', ['riwayat_masuk' => $lokasi]);
    }
}
