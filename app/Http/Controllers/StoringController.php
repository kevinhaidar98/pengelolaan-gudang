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
        //Show barang pada gudang
        $barang = $request->barang;
        //Jika terdapat pencarian form barang
        if ($barang) {
            $lokasi = Lokasi::whereHas('barang', function ($query) use ($barang) {
                return $query->where('id_barang', '=', $barang);
            })->get();
            return view('functions.gudang.dashboard', ['lokasi' => $lokasi]);
        } else {
            //Jika tidak terdapat pencarian pada form barang
            $lokasi = Lokasi::get();
            return view('functions.gudang.dashboard', ['lokasi' => $lokasi]);
        }
    }
    public function showIsiGudang(Request $request)
    {
        //Menampilkan list isi barang pada suatu letak
        $lokasi = Lokasi::findOrFail($request->id);
        $barangs = [];
        foreach ($lokasi->barang as $barang) {
            $barang['jumlah'] = $barang->pivot->jumlah;
            $barang['id_lokasi'] = $barang->pivot->id_lokasi;
            array_push($barangs, $barang);
        }
        return view('functions.gudang.isigudang', ['items' => $barangs]);
    }
    public function addIsiGudang(Request $request)
    {
        //menampilkan halaman tambah isi gudang
        return view('functions.gudang.addisigudang');
    }
    public function getBarangList(Request $request)
    {
        //menampilkan barang pada JS halaman tambah isi gudang
        $keyword = $request->q;
        $items = Barang::where('nama_barang', 'LIKE', "%$keyword%")->get();
        return $items;
    }
    public function createIsiGudang(Request $request)
    {
        //Create isi gudang
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
        //Masuk ke halaman edit isi gudang dengan membawa beberapa data yang dipilih
        $data = DB::table('lokasi_barang')
            ->join('barang', 'barang.id', '=', 'lokasi_barang.id_barang')
            ->select('lokasi_barang.*', 'barang.nama_barang as nama_barang')
            ->where('id_lokasi', $request->id_lokasi)
            ->where('id_barang', $request->id_barang)
            ->get();
        return view('functions.gudang.editisigudang', ['data' => $data]);
    }

    public function updateIsiGudang(Request $request)
    {
        //Penyimpanan data update yang telah diisi pada form editisigudang
        $check = DB::table('lokasi_barang')
            ->select('lokasi_barang.*')
            ->where('id_lokasi', $request->id_lokasi)
            ->get();

        //Jumlah merupakan total jumlah isi pada suatu letak gudang untuk pengecekan kapasitas
        $jumlah = 0;

        foreach ($check as $data) {
            $jumlah += $data->jumlah;
        }

        //Check Jumlah merupakan pengecekan jumlah 1 barang yang dipilih
        $checkJumlah = DB::table('lokasi_barang')
            ->join('lokasi', 'lokasi.id', '=', 'lokasi_barang.id_lokasi')
            ->select('lokasi_barang.*', 'lokasi.nama_letak as nama_lokasi')
            ->where('id_lokasi', $request->id_lokasi)
            ->where('id_barang', $request->id_barang)
            ->get();

        //Temp merupakan variabel jumlah total isi pada suatu letak dikurangi jumlah total isi 1 barang ditambah jumlah
        $temp = $jumlah - $checkJumlah[0]->jumlah + $request->jumlah;
        
        //Jika total setelah ditambah melebihi kapasitas gudang maka muncul status
        if ($temp > 20) {
            $temp = 0;
            return redirect()->back()->with('error', 'Letak Penuh! Gunakan letak yang memiliki ruang kosong');
        } else {
            // jika masih dibawah kapsitas maka lanjut disimpan
            $update = DB::table('lokasi_barang')->where('id',$request->id)->update(['jumlah' => $request->jumlah]);
            return redirect()->route('gudang.showisigudang', ['id' => $checkJumlah[0]->id_lokasi, 'nama_letak' => $checkJumlah[0]->nama_lokasi])->with('status', 'Berhasil Update Barang Pada Gudang');
        }

    }
    public function destroyIsi($id){
        $barang = DB::table('lokasi_barang')->where('id',$id);
        $barang->delete();
        return redirect()->back()->with('status', 'Sukses menghapus isi gudang');
    }
}
