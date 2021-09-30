@extends('layout.index',['activePage'=>'gudang'])
@section('title','Dasboard Gudang')

@section('content')
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
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
        <div class="card-body p-0">
          <table class="table table-striped projects">
            {{-- Header Table --}}
              <thead>
                  <tr>
                      <th style="width: 20%">
                          Nama Barang
                      </th>
                      <th style="width: 20%">
                          Kode Transaksi
                      </th>
                      <th style="width: 10%">
                          Jumlah
                      </th>
                      <th style="width: 20%">
                        Tanggal Masuk
                      </th>
                      <th style="width: 20%; text-align: center">
                          Aksi
                      </th>
                  </tr>
              </thead>
              {{-- Table Body --}}
              @if($barang->count()==0)
              <tbody>
                <td colspan="6" style="text-align: center;padding-top: 3%">Tidak ada data barang yang dibuat</td>
                @else
                @foreach ($barang as $item)
                  <tr>
                      {{-- Nama --}}
                      <td>
                         {{$item->nama_barang}} 
                      </td>
                      {{-- Username --}}
                      <td>
                        {{$item->jumlah}} 
                      </td>
                      {{-- Telepon --}}
                      {{-- Aksi --}}
                      <td class="project-actions text-center">
                          <a class="btn btn-info btn-sm" href="{{route('barang.editbarang',[$item->id])}}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm delete-barang" href="{{route('barang.deletebarang',[$item->id])}}">
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
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <div class="row">
        <div class="col-6">
          <a href="{{route('barang.addbarang')}}" class="btn btn-primary">Tambah Barang</a>
        </div>
      </div>
    </section>
    <script type="text/javascript">
      $('.delete-barang').click(function () {
        var barangId = $(this).data('id');
        console.log(barangId)
        event.preventDefault();
        swal({
          title: 'Yakin ingin menghapus data?',
          text: 'Data yang sudah dihapus tidak akan bisa dikembalikan',
          icon: 'warning',
          buttons: ["Tidak", "Ya"],
        }).then(function (value) {
          if (value) {
            window.location.href = "deleteuser/" + barangId;
          }
        });
      });
    </script>
@endsection