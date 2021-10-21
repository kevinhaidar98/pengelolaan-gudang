@extends('layout.index',['activePage'=>'barang'])
@section('title', 'Dasboard Barang')

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
                <h3 class="card-title">Daftar Barang</h3>

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
                    <div class="col mb-3">
                        <a href="{{ route('barang.addbarang') }}" class="btn btn-primary">Tambah Barang Baru</a>
                    </div>
                </div>
                <div class="row table-responsive">
                    <table id="tabelbarang" class="table table-striped projects">
                        {{-- Header Table --}}
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center">
                                    Kode Barang
                                </th>
                                <th style="width: 30%">
                                    Nama Barang
                                </th>
                                <th style="width: 10%; text-align: center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        {{-- Table Body --}}
                        @if ($barang->count() == 0)
                            <tbody>
                                <td colspan="6" style="text-align: center;padding-top: 3%">Tidak ada data barang yang dibuat
                                </td>
                            @else
                                @foreach ($barang as $item)
                                    <tr>
                                        <td style="text-align: center">
                                            {{ $item->id }}
                                        </td>
                                        {{-- Nama --}}
                                        <td>
                                            {{ $item->nama_barang }}
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('barang.editbarang', [$item->id]) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm delete-barang"
                                                href="{{ route('barang.deletebarang', [$item->id]) }}">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
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

    </section>
    <script type="text/javascript">
        $(function() {
            $("#tabelbarang").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#tabelbarang_wrapper .col-md-6:eq(0)');
        })
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
