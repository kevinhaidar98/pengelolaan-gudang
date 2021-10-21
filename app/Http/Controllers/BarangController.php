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
            $barang = Barang::get();
        }
        return view('functions.barang.dashboard', ['barang'=> $barang]);
    }
    public function showBarangForm(Request $request){
        $state = $request->state;
        return view('functions.barang.addbarang',['state' => $state]);
    }

    public function createBarang(Request $request){
        $state = $request->state;
        $validate = Validator::make($request->all(), [
            'nama_barang'=>'required|min:5',
        ], [
            'nama_barang.required'=>'Nama barang harus diisi',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error','Semua field tidak boleh kosong');
        }else{
            $barang = new Barang();
            $barang->nama_barang = $request->nama_barang;
            $barang->save();
            if($state){
                return redirect()->route('transaksimasuk.showformtransaksimasuk')->with('status', 'Sukses menambahkan data barang');
            }else {
                return redirect()->route('barang.showbaranglist')->with('status', 'Sukses menambahkan data barang');
            }
        }
    }
    
    public function editBarang($id){
        $barang = Barang::findOrFail($id);
        return view('functions.barang.editbarang', ['barang' => $barang]);
    }

    public function updateBarang(Request $request, $id){
        $validate = Validator::make($request->all(), [
            'nama_barang'=>'required|min:5'
        ], [
            'nama_barang.required'=>'Nama barang harus diisi',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error','Semua field tidak boleh kosong');
        }else{
            $barang = Barang::findOrFail($id);
            $barang->nama_barang = $request->nama_barang;
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
