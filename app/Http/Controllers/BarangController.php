<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;

class BarangController extends Controller
{
    public function __construct()
    {
        try{
            DB::connection()->getPdo();
        } catch (\Exception $e){
            die("Database tidak terhubung");
        }
    }

    public function showBarangList(Request $request)
    {
        $selection = $request->keyword;
        if($selection){
            $barang = Barang::where('nama', 'LIKE', "%$selection%")->paginate(10);
        } else {
            $barang = Barang::paginate(10);
        }
        return view('functions.barang.dashboard', ['barang'=> $barang]);
    }
    public function showBarangForm(){
        return view('functions.barang.addbarang');
    }

    public function createBarang(Request $request){
        $validate = Validator::make($request->all(), [
            'nama_barang'=>'required|min:5',
            'jumlah' => 'required',
        ], [
            'nama_barang.required'=>'Nama barang harus diisi',
            'jumlah.required' => 'Jumlah harus diisi',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error','Semua field tidak boleh kosong');
        }else{
            $barang = new Barang();
            $barang->nama_barang = $request->nama_barang;
            $barang->jumlah = $request->jumlah;
            $barang->save();
            return redirect()->route('barang.showbaranglist')->with('status', 'Sukses menambahkan data barang');
        }
    }
    
    public function editBarang($id){
        $barang = Barang::findOrFail($id);
        return view('functions.barang.editbarang', ['barang' => $barang]);
    }

    public function updateBarang(Request $request, $id){
        $validate = Validator::make($request->all(), [
            'nama_barang'=>'required|min:5',
            'jumlah' => 'required',
        ], [
            'nama_barang.required'=>'Nama barang harus diisi',
            'jumlah.required' => 'Jumlah harus diisi',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error','Semua field tidak boleh kosong');
        }else{
            $barang = Barang::findOrFail($id);
            $barang->nama_barang = $request->nama_barang;
            $barang->jumlah = $request->jumlah;
            $barang->save();
            return redirect()->route('barang.showbaranglist')->with('status', 'Sukses menambahkan data barang');
        }
    }

    public function destroyBarang($id){
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->back()->with('status', 'Sukses menghapus data barang');
    }

}
