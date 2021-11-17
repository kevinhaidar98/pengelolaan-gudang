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
        $barang = $request->barang;
        if ($barang) {
            $lokasi = Lokasi::whereHas('barang', function ($query) use ($barang) {
                return $query->where('id_barang', '=', $barang);
            })->get();
            return view('functions.gudang.dashboard', ['lokasi' => $lokasi]);
        } else {
            $lokasi = Lokasi::get();
            return view('functions.gudang.dashboard', ['lokasi' => $lokasi]);
        }
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
            $barang['id_lokasi'] = $barang->pivot->id_lokasi;
            array_push($barangs, $barang);
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
    public function getBarangList(Request $request)
    {
        $keyword = $request->q;
        $items = Barang::where('nama_barang', 'LIKE', "%$keyword%")->get();
        return $items;
    }
    public function createIsiGudang(Request $request)
    {
        //dd($request);
        $validate = Validator::make($request->all(), [
            'barang' => 'required',
            'jumlah' => 'required'
        ], [
            'barang.required' => 'Pilih Barang!',
            'jumlah.required' => 'Jumlah harus diisi'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Semua field tidak boleh kosong');
        } else {
            $lokasi = Lokasi::findOrFail($request->id_lokasi);
            $barang = $request->barang;
            $jumlah = $request->jumlah;
            $lokasi->barang()->attach($barang, ['jumlah' => $jumlah]);
            return redirect()->route('gudang.showisigudang', ['id' => $request->id_lokasi, 'nama_letak' => $request->nama_letak])->with('status', 'Sukses menambahkan barang');
        }
    }
    public function editIsiGudang(Request $request)
    {
        // $coba = $request;
        // dd($coba);
        $data = DB::table('lokasi_barang')
            ->join('barang', 'barang.id', '=', 'lokasi_barang.id_barang')
            ->select('lokasi_barang.*', 'barang.nama_barang as nama_barang')
            ->where('id_lokasi', $request->id_lokasi)
            ->where('id_barang', $request->id_barang)
            ->get();

        // $data = DB::table('lokasi_barang')
        //     ->select('lokasi_barang.*')
        //     ->where('id_lokasi', $request->id_lokasi)
        //     ->where('id_barang', $request->id_barang)
        //     ->get();
        //dd($data);
        return view('functions.gudang.editisigudang', ['data' => $data]);
    }

    public function updateIsiGudang(Request $request)
    {
        //dd($request);
        $check = DB::table('lokasi_barang')
            ->select('lokasi_barang.*')
            ->where('id_lokasi', $request->id_lokasi)
            ->get();

        $jumlah = 0;

        foreach ($check as $data) {
            $jumlah += $data->jumlah;
        }

        $checkJumlah = DB::table('lokasi_barang')
            ->join('lokasi', 'lokasi.id', '=', 'lokasi_barang.id_lokasi')
            ->select('lokasi_barang.*', 'lokasi.nama_letak as nama_lokasi')
            ->where('id_lokasi', $request->id_lokasi)
            ->where('id_barang', $request->id_barang)
            ->get();

        //dd($checkJumlah[0]);
            
        $temp = $jumlah - $checkJumlah[0]->jumlah + $request->jumlah;
        
        //dd($temp);
        if ($temp > 20) {
            $temp = 0;
            return redirect()->back()->with('error', 'Letak Penuh! Gunakan letak yang memiliki ruang kosong');
        } else {
            $update = DB::table('lokasi_barang')->where('id',$request->id)->update(['jumlah' => $request->jumlah]);
            return redirect()->route('gudang.showisigudang', ['id' => $checkJumlah[0]->id_lokasi, 'nama_letak' => $checkJumlah[0]->nama_lokasi])->with('status', 'Berhasil Update Barang Pada Gudang');
        }

    }
}
