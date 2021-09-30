@extends('layout.index',['activePage'=>'gudang'])
@section('title', 'Dasboard Gudang')

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
                <h3 class="card-title">Gudang</h3>

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
                {{-- Ruang A --}}
                <div class="row p-2">
                    @foreach ($lokasi as $item)
                    <a class="col m-2 text-center border border-primary" href="#1">
                        <input type="text" class="knob" value="30" data-width="120" data-height="120"
                            data-fgColor="#3c8dbc" data-readonly="true">
                        <div class="knob-label">{{ $item->nama_letak }}</div>
                    </a>
                    @endforeach
                    <a class="col m-2 text-center border border-primary" href="#1">
                        <input type="text" class="knob" value="30" data-width="120" data-height="120"
                            data-fgColor="#3c8dbc" data-readonly="true">
                        <div class="knob-label">A1</div>
                    </a>
                    

                    <!-- ./col -->
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



