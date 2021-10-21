@extends('layout.index',['activePage'=>'transaksimasuk'])
@section('title', 'Transaksi Masuk')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Transaksi Masuk</h3>

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
            <form action="{{ route('transaksimasuk.createtransaksimasuk', ['id_user' => Auth::user()->id]) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Pilih Barang</label>
                    <select name="barang" style="width: 100%" id="barang" class="form-control"></select>
                </div>
                <div class="form-group {{ $errors->has('jumlah') ? ' has-danger' : '' }}">
                    <label for="inputJumlah">Jumlah</label>
                    <input class="form-control {{ $errors->has('jumlah') ? ' is-invalid' : '' }}"
                        value="{{ old('jumlah') }}" placeholder="Jumlah" type="number" name="jumlah" id="jumlah" />
                    @include('layout.alert',['field'=> 'jumlah'])
                </div>
                <div class="form-group {{ $errors->has('klien') ? ' has-danger' : '' }}">
                    <label for="inputKlien">Klien</label>
                    <input class="form-control {{ $errors->has('klien') ? ' is-invalid' : '' }}"
                        value="{{ old('klien') }}" placeholder="Klien" type="text" name="klien" id="klien" />
                    @include('layout.alert',['field'=> 'klien'])
                </div>
                <label for="inputJumlah" class="">Tanggal</label>
                <div class="input-group" id="reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"
                        id="reservationdate" name="reservationdate" value="{{ old('reservationdate') }}" readonly />
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
                <br />
                <input class="btn btn-primary" type="submit" value="Simpan" />
            </form>
            <br>
            <div class="row">
                <div class="col-auto">
                    <a class="btn btn-success" href="{{ route('barang.addbarang', ['state' => 1]) }}">Tambah Barang
                        Baru</a>
                </div>
                <div class="col-auto">
                    <h6 class="">*Jika barang tidak ditemukan</h6>
                </div>
            </div>
            <!-- /.card-body -->
        </div>


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

                $(function() {
                    $('#reservationdate').datetimepicker({
                        format: 'YYYY-MM-DD'
                    })
                })
            </script>

        @endpush
    @endsection
