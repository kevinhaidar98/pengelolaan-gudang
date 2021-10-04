@extends('layout.index',['activePage'=>'user'])
@section('title','Tambah Isi Gudang')

@section('content')

    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Tambah Isi Gudang</h3>

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
                <div class="form-group">
                    <label>Pilih Barang</label>
                    <select class="form-control">
                      <option>Batik Tulis Coklat Muda</option>
                      <option>Batik Tulis Hitam</option>
                      <option>Batik Tulis Putih</option>
                      <option>Batik Tulis Biru</option>
                      <option>Batik Tulis Hijau</option>
                    </select>
                  </div>
                  <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label for="inputName">Jumlah</label>
                    <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}"  placeholder="Nama" type="text" name="nama" id="nama"/>
                    @include('layout.alert',['field'=> 'nama'])
                </div>
                <input class="btn btn-primary" type="submit" value="Simpan" />
            </form>
            
        <!-- /.card-body -->
    </div>
@endsection
