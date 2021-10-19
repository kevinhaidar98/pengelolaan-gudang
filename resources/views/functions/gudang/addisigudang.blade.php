@extends('layout.index',['activePage'=>'user'])
@section('title', 'Tambah Isi Gudang Ruang - ' . request()->route('nama_letak'))

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
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form
                action="{{ route('gudang.createisigudang', ['id_lokasi' => request()->route('id'), 'nama_letak' => request()->route('nama_letak')]) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Pilih Barang</label>
                    <select name="barang" style="width: 100%" id="barang" class="form-control"></select>
                </div>
                <div class="form-group {{ $errors->has('jumlah') ? ' has-danger' : '' }}">
                    <label for="inputName">Jumlah</label>
                    <input class="form-control {{ $errors->has('jumlah') ? ' is-invalid' : '' }}"
                        value="{{ old('jumlah') }}" placeholder="Jumlah" type="number" name="jumlah" id="jumlah" />
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
                        url: 'http://127.0.0.1:8000/gudang/barang/list',
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
