<aside class="main-sidebar sidebar-light-primary elevation-2">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('dist/img/box2.png') }}" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">Pengelolaan Gudang</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          @if (Auth::user()->id_role == 1)
          <li class="nav-item @if ($activePage == 'user') active @endif" >
            <a class="nav-link" href="{{route('user.showuserlist')}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          <li class="nav-item @if ($activePage == 'user') active @endif" >
            <a class="nav-link" href="{{route('gudang.showgudang')}}">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Gudang
              </p>
            </a>
          </li>
          <li class="nav-item @if ($activePage == 'user') active @endif" >
            <a class="nav-link" href="{{route('barang.showbaranglist')}}">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Barang
              </p>
            </a>
          </li>
          {{-- <li class="nav-item @if ($activePage == 'user') active @endif" >
            <a class="nav-link" href="{{ route('masuk.showtranslist') }}">
              <i class="nav-icon fas fa-arrow-down"></i>
              <p>
                Transaksi Masuk
              </p>
            </a>
          </li> --}}
          @endif
          <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon fas fa-arrow-up"></i>
              <p>
                Transaksi Keluar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Kanban Board
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>