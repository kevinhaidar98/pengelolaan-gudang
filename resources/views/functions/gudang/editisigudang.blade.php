@extends('layout.index',['activePage'=>'gudang'])
@section('title', 'Edit Isi Gudang')

@section('content')
    
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Isi Gudang</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form
                action="{{ route('gudang.updateisigudang', ['id' => $data[0]->id, 'id_barang' => $data[0]->id_barang, 'id_lokasi' => $data[0]->id_lokasi]) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    {{-- <label>Pilih Barang</label>
                    <select name="barang" style="width: 100%" id="barang" class="form-control" disabled></select> --}}
                    <label for="inputName">Nama Barang</label>
                    <input class="form-control {{ $errors->has('nama_barang') ? ' is-invalid' : '' }}"
                        value="{{ $data[0]->nama_barang }}" placeholder="Jumlah" type="text" name="nama_barang" id="nama_barang" disabled/>
                </div>
                <div class="form-group {{ $errors->has('jumlah') ? ' has-danger' : '' }}">
                    <label for="inputName">Jumlah</label>
                    <input class="form-control {{ $errors->has('jumlah') ? ' is-invalid' : '' }}"
                        value="{{ $data[0]->jumlah }}" placeholder="Jumlah" type="number" name="jumlah" id="jumlah" />
                    @include('layout.alert',['field'=> 'jumlah'])
                </div>
                <input class="btn btn-primary" type="submit" value="Simpan" />
            </form>

            <!-- /.card-body -->
        </div>
    @endsection
    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#barang').select2({
                    ajax: {
                        url: 'http://web.ducraft.online/gudang/barang/list',
                        delay: 500,
                        processResults: function(data) {
                            return {
                                results: data.map((item) => {
                                    return {
                                        id: item.id,
                                        text: item.nama_barang
                                    }
                                })
                            }
                        }
                    }
                });
            });
        </script>

    @endpush
