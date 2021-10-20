@extends('layout.index',['activePage'=>'transaksiKeluar'])
@section('title', 'Dasboard Transaksi Keluar')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <!-- Content  -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaksi Keluar</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-2">
                <div class="row">
                    <label class="col-1">Tanggal :</label>
                    <form action="{{ route('transaksikeluar.showtransaksikeluardate') }}" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="form-inline">
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input"
                                    data-target="#reservationdate" id="reservationdate" name="reservationdate" value="{{ old('reservationdate') }}"/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.input group -->
                            <button class="btn btn-primary m-1" type="submit">Cari</button>
                        </div>
                    </form>
                    <a class="col-2 btn btn-primary m-1" href="#">
                        Tambah Transaksi Keluar
                    </a>
                </div>
                <div class="row">
                    <table class="table table-striped table-hover">
                        {{-- Header Table --}}
                        <thead>
                            <tr>
                                <th style="width: 10%">
                                    Kode Transaksi
                                </th>
                                <th style="width: 10%">
                                    Nama Barang
                                </th>
                                <th style="width: 5%; text-align: center">
                                    Jumlah
                                </th>
                                <th style="width: 15%">
                                    Klien
                                </th>
                                <th style="width: 10%; text-align: center">
                                    Admin
                                </th>
                                <th style="width: 10%; text-align: center">
                                    Tanggal
                                </th>
                                <th style="width: 5%; text-align: center">
                                    Status
                                </th>
                                <th style="width: 20%">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        {{-- Table Body --}}
                        @if ($transaksi->count() == 0)
                            <tbody>
                                <tr>
                                    <td colspan="8" style="text-align: center;">Tidak ada data barang yang dibuat
                                    </td>
                                </tr>
                            @else
                                @foreach ($transaksi as $item)
                                    <tr>
                                        {{-- Kode Transaksi --}}
                                        <td>
                                            {{ $item->kode_transaksi }}
                                        </td>

                                        {{-- Nama Barang --}}
                                        <td>
                                            {{ $item->nama_barang }}
                                        </td>

                                        {{-- Jumlah --}}
                                        <td style="text-align: center">
                                            {{ $item->jumlah }}
                                        </td>

                                        {{-- Klien --}}
                                        <td>
                                            {{ $item->klien }}
                                        </td>

                                        {{-- Admin --}}
                                        <td style="text-align: center">
                                            {{ $item->nama_user }}
                                        </td>

                                        {{-- Tanggal --}}
                                        <td style="text-align: center">
                                            {{ $item->tanggal }}
                                        </td>

                                        <td style="text-align: center">
                                            @if ($item->is_process == 0)
                                                <span class="badge badge-danger">
                                                    Belum diproses
                                                </span>
                                            @else
                                                <span class="badge badge-success">
                                                    Sudah diproses
                                                </span>
                                            @endif
                                        </td>
                                        {{-- Aksi --}}
                                        <td class="project-actions text-center">
                                            <div class="row">
                                                @if ($item->is_process == 0)
                                                    <a class="col btn btn-info btn-sm m-1"
                                                        href="{{ route('barang.editbarang', [$item->id]) }}">
                                                        <i class="fas fa-check-circle">
                                                        </i>
                                                        Proses
                                                    </a>
                                                @else
                                                    <a class="col btn btn-secondary btn-sm m-1 disabled"
                                                        href="{{ route('barang.editbarang', [$item->id]) }}">
                                                        <i class="fas fa-check-circle">
                                                        </i>
                                                        Proses
                                                    </a>
                                                @endif
                                                <a class="col btn btn-danger btn-sm delete-barang m-1"
                                                    href="{{ route('barang.deletebarang', [$item->id]) }}">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="row">
            <div class="col-6">
                <a href="{{ route('barang.addbarang') }}" class="btn btn-primary">Tambah Barang</a>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(function() {
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD'
            })
        })

        // $('.delete-barang').click(function() {
        //     var barangId = $(this).data('id');
        //     console.log(barangId)
        //     event.preventDefault();
        //     swal({
        //         title: 'Yakin ingin menghapus data?',
        //         text: 'Data yang sudah dihapus tidak akan bisa dikembalikan',
        //         icon: 'warning',
        //         buttons: ["Tidak", "Ya"],
        //     }).then(function(value) {
        //         if (value) {
        //             window.location.href = "deleteuser/" + barangId;
        //         }
        //     });
        // });
        // $('#datetime').inputmask('dd/mm/yyyy', {
        //     'placeholder': 'dd/mm/yyyy'
        // })
    </script>
@endsection
