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
                <h3 class="card-title">Ruang - Letak</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-4">
                {{-- Ruang A --}}


                <form
                    action="{{ route('gudang.showgudang', ['id_lokasi' => request()->route('id'), 'nama_letak' => request()->route('nama_letak')]) }}"
                    method="get" enctype="multipart/form-data">
                    @csrf
                    <div class="row p-2">
                        <h5 class="col-4">Barang : </h5>
                        <div class="col-5 form-group">
                            <select name="barang" style="width: 100%" id="barang" class="form-control"></select>
                        </div>
                        <input class="col-3 btn-sm btn-primary" style="height: 5%" type="submit" value="Cari" />
                    </div>
                </form>

                <div class="row">
                    @foreach ($lokasi as $item)
                        @php $jumlah=0 @endphp
                        @foreach ($item->barang as $detail)
                            @php
                                $jumlah += $detail->pivot->jumlah;
                            @endphp
                        @endforeach
                        @if ($jumlah <= 7)
                            <a class="col p-2 m-2 text-center border border-success"
                                href="{{ route('gudang.showisigudang', ['id' => $item->id, 'nama_letak' => $item->nama_letak]) }}">
                                <input type="text" class="knob" value="{{ $jumlah }}" data-width="120"
                                    data-height="120" data-fgColor="#28a745" data-readonly="true" data-max="20">
                                <div class="knob-label text-success">{{ $item->nama_letak }}</div>
                            </a>
                        @elseif($jumlah >= 7 && $jumlah <= 15) <a class="col p-2 m-2 text-center border border-warning"
                                href="{{ route('gudang.showisigudang', ['id' => $item->id, 'nama_letak' => $item->nama_letak]) }}">
                                <input type="text" class="knob" value="{{ $jumlah }}" data-width="120"
                                    data-height="120" data-fgColor="#ffc107" data-readonly="true" data-max="20">
                                <div class="knob-label text-warning">{{ $item->nama_letak }}</div>
                                </a>
                            @else
                                <a class="col p-2 m-2 text-center border border-danger"
                                    href="{{ route('gudang.showisigudang', ['id' => $item->id, 'nama_letak' => $item->nama_letak]) }}">
                                    <input type="text" class="knob" value="{{ $jumlah }}" data-width="120"
                                        data-height="120" data-fgColor="#dc3545" data-readonly="true" data-max="20">
                                    <div class="knob-label text-danger">{{ $item->nama_letak }}</div>
                                </a>
                        @endif

                    @endforeach

                    <!-- ./col -->
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
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
