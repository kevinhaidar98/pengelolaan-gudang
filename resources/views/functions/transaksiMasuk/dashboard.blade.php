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
            <div class="card-body p-0">
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
                            <th style="width: 5% text-align: center">
                                Jumlah
                            </th>
                            <th style="width: 15%">
                                Klien
                            </th>
                            <th style="width: 10%">
                                Admin
                            </th>
                            <th style="width: 10%">
                                Tanggal
                            </th>
                            <th style="width: 15% text-align: center">
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
                            <td colspan="6" style="text-align: center;padding-top: 3%">Tidak ada data barang yang dibuat
                            </td>
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
                                    <td>
                                        {{ $item->nama_user }}
                                    </td>

                                    {{-- Tanggal --}}
                                    <td>
                                        {{ $item->tanggal }}
                                    </td>

                                    <td>
                                        @if ($item->is_process == 0)
                                            <div class="btn btn-danger m-1">
                                                Belum di proses
                                            </div>
                                        @else
                                            <div class="btn btn-success m-1">
                                                Sudah di proses
                                            </div>
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
    </script>
@endsection
