@extends('layout.index',['activePage'=>'user'])
@section('title', 'Dasboard User')

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
                <h3 class="card-title">Daftar Pengguna</h3>

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
                            <th style="width: 20%">
                                Name
                            </th>
                            <th style="width: 10%">
                                Username
                            </th>
                            <th>
                                Telepon
                            </th>
                            <th style="width: 30%">
                                Alamat
                            </th>
                            <th style="width: 10%">
                                Role
                            </th>
                            <th style="width: 20%; text-align: center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    {{-- Table Body --}}
                    @if ($users->count() == 0)
                        <tbody>
                            <td colspan="6" style="text-align: center;padding-top: 3%">Tidak ada data user yang dibuat</td>
                        @else
                            @foreach ($users as $item)
                                <tr>
                                    {{-- Nama --}}
                                    <td>
                                        {{ $item->nama }}
                                    </td>
                                    {{-- Username --}}
                                    <td>
                                        {{ $item->username }}
                                    </td>
                                    {{-- Telepon --}}
                                    <td>
                                        {{ $item->telepon }}
                                    </td>
                                    {{-- Alamat --}}
                                    <td>
                                        {{ $item->alamat }}
                                    </td>
                                    {{-- Role --}}
                                    @switch($item->id_role)
                                        @case(1)
                                            <td>
                                                Super Admin
                                            </td>
                                        @break
                                        @case(2)
                                            <td>
                                                Admin Masuk
                                            </td>
                                        @break
                                        @case(3)
                                            <td>
                                                Admin Keluar
                                            </td>
                                        @break
                                        @case(4)
                                            <td>
                                                Pemilik
                                            </td>
                                        @break
                                    @endswitch

                                    {{-- Aksi --}}
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('user.edituser', [$item->id]) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm delete-user"
                                            href="{{ route('user.deleteuser', [$item->id]) }}">
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
                <a href="{{ route('user.adduser') }}" class="btn btn-primary">Tambah Pengguna</a>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $('.delete-user').click(function() {
            var userId = $(this).data('id');
            console.log(userId)
            event.preventDefault();
            swal({
                title: 'Yakin ingin menghapus data?',
                text: 'Data yang sudah dihapus tidak akan bisa dikembalikan',
                icon: 'warning',
                buttons: ["Tidak", "Ya"],
            }).then(function(value) {
                if (value) {
                    window.location.href = "deleteuser/" + userId;
                }
            });
        });
    </script>
@endsection
