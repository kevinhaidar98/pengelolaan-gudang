@extends('layout.index',['activePage'=>'user'])
@section('title','Tambah Pengguna')

@section('content')

    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Tambah Pengguna</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
            </button>
        </div>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            <form action="{{route('user.createuser')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label for="inputName">Nama</label>
                    <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}"  placeholder="Nama" type="text" name="nama" id="nama"/>
                    @include('layout.alert',['field'=> 'nama'])
                </div>
                <div class="form-group {{ $errors->has('username') ? ' has-danger' : '' }}">
                    <label for="inputUsername">Username</label>
                    <input class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}"  placeholder="Username" type="text" name="username" id="username"/>
                    @include('layout.alert',['field'=> 'username'])
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label for="inputPassword">Password</label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}"  placeholder="Password" type="password" name="password" id="password"/>
                    @include('layout.alert',['field'=> 'password'])
                </div>
                <div class="form-group {{ $errors->has('telepon') ? ' has-danger' : '' }}">
                    <label for="inputTelepon">Telepon</label>
                    <input class="form-control {{ $errors->has('telepon') ? ' is-invalid' : '' }}" value="{{ old('telepon') }}"  placeholder="Telepon" type="text" name="telepon" id="telepon"/>
                    @include('layout.alert',['field'=> 'telepon'])
                </div>
                <div class="form-group {{ $errors->has('alamat') ? ' has-danger' : '' }}">
                    <label for="inputAlamat">Alamat</label>
                    <input class="form-control {{ $errors->has('alamat') ? ' is-invalid' : '' }}" value="{{ old('alamat') }}"  placeholder="Alamat" type="text" name="alamat" id="alamat"/>
                    @include('layout.alert',['field'=> 'alamat'])
                </div>
                <div class="form-group {{ $errors->has('role') ? ' has-danger' : '' }}">
                    <label for="role">Role</label>
                    <br />
                    <input type="radio" name="role" id="superadmin" value="1" />
                    <label for="Super Admin">Super Admin</label>
                    <br />
                    <input type="radio" name="role" id="adminmasuk" value="2" />
                    <label for="Admin Masuk">Admin Masuk</label>
                    <br />
                    <input type="radio" name="role" id="adminkeluar" value="3" />
                    <label for="Admin Keluar">Admin Keluar</label>
                    <br />
                    <input type="radio" name="role" id="pemilik" value="4" />
                    <label for="Pemilik">Pemilik</label>
                </div>
                <br />
                <input class="btn btn-primary" type="submit" value="Simpan" />
            </form>
            
        <!-- /.card-body -->
    </div>
@endsection
