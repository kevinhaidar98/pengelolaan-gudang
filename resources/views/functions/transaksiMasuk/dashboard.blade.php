@extends('layout.index',['activePage'=>'transaksiMasuk'])
@section('title', 'Dasboard Transaksi Masuk')

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
                <h3 class="card-title">Transaksi Masuk</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('transaksimasuk.showtransaksimasukdate') }}" method="get"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex">
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"
                                    id="reservationdate" placeholder="Tanggal" name="reservationdate"
                                    value="{{ old('reservationdate') }}" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.input group -->
                            <button class="col-auto btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>
                    <div class="col-auto">
                        <a class="btn btn-primary" href="{{ route('transaksimasuk.showformtransaksimasuk') }}">
                            Tambah Transaksi Masuk
                        </a>
                    </div>
                </div>
                <br>
                <div class="row table-responsive">
                    <table id="tabelmasuk" class="table table-striped table-hover">
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
                                                        href="{{ route('transaksimasuk.proses', [$item->id]) }}">
                                                        <i class="fas fa-check-circle">
                                                        </i>
                                                        Proses
                                                    </a>
                                                @else
                                                    <a class="col btn btn-secondary btn-sm m-1 disabled">
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
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <script type="text/javascript">
        $(function() {
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD'
            })
            $("#tabelmasuk").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#tabelmasuk_wrapper .col-md-6:eq(0)');
        });
        $('.delete-barang').click(function() {
            var barangId = $(this).data('id');
            console.log(barangId)
            event.preventDefault();
            swal({
                title: 'Yakin ingin menghapus data?',
                text: 'Data yang sudah dihapus tidak akan bisa dikembalikan',
                icon: 'warning',
                buttons: ["Tidak", "Ya"],
            }).then(function(value) {
                if (value) {
                    window.location.href = "deleteuser/" + barangId;
                }
            });
        });
    });
</script>
@endsection
