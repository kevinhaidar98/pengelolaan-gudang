@extends('layout.index',['activePage'=>'user'])
@section('title','Isi Ruang - '.request()->route('nama_letak'))
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
        <div class="card-body p-0 table-responsive">
          <table class="table table-striped projects">
            {{-- Header Table --}}
              <thead>
                  <tr>
                      <th style="width: 5%; text-align: center">
                          Kode Barang
                      </th>
                      <th style="width: 30%">
                          Nama Barang
                      </th>
                      <th style="width: 5%; text-align: center">
                          Jumlah
                      </th>
                      <th style="width: 10%; text-align: center">
                          Aksi
                      </th>
                  </tr>
              </thead>
              {{-- Table Body --}}
              @php
                  $jumlah = 0;
              @endphp
              @if(count($items) == 0)
              <tbody>
                <td colspan="6" style="text-align: center;padding-top: 3%">Tidak ada data barang yang tersimpan</td>
                @else
                @php
                    $isFull = '';
                @endphp
                @foreach ($items as $item)
                  <tr>
                      {{-- Nama --}}
                      <td style="text-align: center">
                         {{$item->id}} 
                      </td>
                      {{-- Username --}}
                      <td>
                        {{$item->nama_barang}} 
                      </td>
                      {{-- Telepon --}}
                      <td style="text-align: center">
                        {{$item->jumlah}} 
                      </td>
                      {{-- Aksi --}}
                      <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm" href="{{route('user.edituser',[$item->id])}}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm delete-user" href="{{route('user.deleteuser',[$item->id])}}">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>
                  </tr>
                  @php
                      $jumlah += $item->jumlah;
                  @endphp
                  @endforeach
                  @endif
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      @if ($jumlah == 20)
      <div class="row">
        <div class="col-6">
          <a href="{{route('gudang.addisigudang',['id' => request()->route('id'),'nama_letak' => request()->route('nama_letak')])}}" class="btn btn-primary disabled">Tambah Barang</a>
        </div>
      </div>
      @else
      <div class="row">
        <div class="col-6">
          <a href="{{route('gudang.addisigudang',['id' => request()->route('id'),'nama_letak' => request()->route('nama_letak')])}}" class="btn btn-primary">Tambah Barang</a>
        </div>
      </div>
      @endif
      
    </section>
    <script type="text/javascript">
      $('.delete-user').click(function () {
        var userId = $(this).data('id');
        console.log(userId)
        event.preventDefault();
        swal({
          title: 'Yakin ingin menghapus data?',
          text: 'Data yang sudah dihapus tidak akan bisa dikembalikan',
          icon: 'warning',
          buttons: ["Tidak", "Ya"],
        }).then(function (value) {
          if (value) {
            window.location.href = "deleteuser/" + userId;
          }
        });
      });
    </script>
@endsection