<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        try{
            DB::connection()->getPdo();
        } catch (\Exception $e){
            die("Database tidak terhubung");
        }
    }

    public function showUserList(Request $request){
        $selection = $request->keyword;
        if($selection){
            $user = User::where('nama', 'LIKE', "%$selection%")->paginate(10);
        } else {
            $user = User::paginate(10);
        }
        return view('functions.users.dashboard', ['users'=> $user]);
    }
    
    

    public function showUserForm(){
        return view('functions.users.adduser');
    }

    public function createUser(Request $request){
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'username'=>'required|min:5',
            'password' => 'required|min:8',
            'telepon' => 'required|numeric',
            'alamat' => 'required|min:10',
            'role' => 'required'
        ], [
            'nama.required' => ' Nama harus diisi',
            'username.required'=>'Username harus diisi',
            'password.required' => 'Password harus diisi',
            'telepon.required' => 'Telepon harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'role.required' => 'Role harus diisi'
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error','Semua field tidak boleh kosong');
        }else{
            $user = new User();
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);           
            $user->telepon = $request->telepon;
            $user->alamat = $request->alamat;
            $user->id_role = $request->role;
            $user->save();
            return redirect()->route('user.showuserlist')->with('status', 'Sukses menambahkan data pengguna');
        }
    }
    
    public function editUser($id){
        $user = User::findOrFail($id);
        return view('functions.users.edituser', ['user' => $user]);
    }

    public function destroyUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('status', 'Sukses menghapus data pengguna');
    }

    public function updateUser(Request $request, $id){
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'username'=>'required|min:5',
            'telepon' => 'required|numeric',
            'alamat' => 'required|min:8',
            'role' => 'required'
        ], [
            'nama.required' => ' Nama harus diisi',
            'username.required'=>'Username harus diisi',
            'telepon.required' => 'Telepon harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'role.required' => 'Role harus diisi'
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error','Semua field tidak boleh kosong');
        }else{
            $user = User::findOrFail($id);
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->telepon = $request->telepon;
            $user->alamat = $request->alamat;
            $user->id_role = $request->role;
            $user->save();
            return redirect()->route('user.showuserlist')->with('status', 'Sukses mengubah data pengguna');
        }
    }

}
