@extends('layout.index',['activePage'=>'barang'])
@section('title','Edit Barang')

@section('content')

    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Edit Barang</h3>

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
            <form action="{{route('barang.updatebarang',[$barang->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group {{ $errors->has('nama_barang') ? ' has-danger' : '' }}">
                    <label for="inputName">Nama Barang</label>
                    <input class="form-control {{ $errors->has('nama_barang') ? ' is-invalid' : '' }}" value="{{ $barang->nama_barang }}"  placeholder="Nama Barang" type="text" name="nama_barang" id="nama_barang"/>
                    @include('layout.alert',['field'=> 'nama_barang'])
                </div>
                <input class="btn btn-primary" type="submit" value="Simpan" />
            </form>
            
        <!-- /.card-body -->
    </div>
@endsection
