<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apotik | Telu</title>
    <link rel="icon" href="{{ asset('image/remove.png') }}" type="image/x-icon">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Logo in Tab (Favicon) -->

    <!-- Google Font: Source Sans Pro -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{asset('template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('template/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <!-- Tambahkan di bagian <head> atau layout utama -->
    <link rel="stylesheet"
        href="{{ asset('/template/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <!-- Tambahkan di bagian bawah, sebelum </body> -->
    <script
        src="{{ asset('/template/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('template/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('template/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet"
        href="{{ asset('/template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .custom-sidebar {
            background-color: #01796f;
            /* Ubah dengan kode warna yang diinginkan */
        }
    </style>

    @stack('css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #d3d3d3;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/homepage" class="nav-link" style="color: black; font-weight: bold;">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg') }}" alt="User Image"
                            class="user-image" style="border-radius: 50%; height: 30px; width: 30px;">
                        <span class="d-none d-md-inline"
                            style="color: black; font-weight: bold;">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-item">
                            <div class="media">
                                <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg') }}" alt="User Image"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{ Auth::user()->name }}
                                    </h3>
                                    <p class="text-sm">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item dropdown-footer bg-transparent border-0">
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar custom-sidebar elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <img src="{{asset('template/dist/img/favicon1.png')}}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-dark" style="color: white; font-weight: 900;">Apotik Telu</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('template/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block" style="color: white; font-weight: 900;">{{ Auth::user()->name }}</a>
                    </div>
                </div>
                <hr style="border-top: 7px solid #ffffff; margin: 5px 0;">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt" style="color: white;"></i>
                                <p style="color: white; font-weight: 900;">
                                    Dashboard
                                </p>

                            </a>
                        </li>
                        <li class="nav-header" style="color: white;">MASTER</li>
                        <!-- @can('manage users')
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-circle" style="color: white;"></i>
                                    <p style="color: white; font-weight: 900;">
                                        Pengguna Apotek
                                    </p>
                                </a>
                            </li>
                        @endcan -->
                        @can('manage pengguna')
                            <li class="nav-item">
                                <a href="{{route('users.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-users	" style="color: white;"></i>
                                    <p style="color: white; font-weight: 900;">
                                        Users
                                    </p>

                                </a>
                            </li>
                        @endcan
                        @can('manage kategori')
                            <li class="nav-item">
                                <a href="{{ route('kategori.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-cube" style="color: white;"></i>
                                    <p style="color: white; font-weight: 900;">
                                        Kategori
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can('manage produk')
                            <li class="nav-item">
                                <a href="{{ route('produk.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-cubes" style="color: white;"></i>
                                    <p style="color: white; font-weight: 900;">
                                        Produk
                                    </p>
                                </a>
                            </li>
                        @endcan

                        <!-- @can('manage prodak')
                            <li class="nav-item">
                                <a href="{{ route('prodak.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-cubes" style="color: white;"></i>
                                    <p style="color: white; font-weight: 900;">
                                        Product
                                    </p>
                                </a>
                            </li>
                        @endcan -->
                        <!-- @can('manage member')
                            <li class="nav-item">
                                <a href="{{route('member.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-id-card" style="color: white;"></i>
                                    <p style="color: white; font-weight: 900;">
                                        Member
                                    </p>
                                </a>
                            </li>
                        @endcan -->
                        @can('manage supplier')
                            <li class="nav-item">
                                <a href="{{route('supplier.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-shipping-fast" style="color: white;"></i>
                                    <p style="color: white; font-weight: 900;">
                                        Supplier
                                    </p>
                                </a>
                            </li>
                        @endcan
                        <!-- @can('manage pengeluaran')
                            <li class="nav-header" style="color: white;">TRANSAKSI</li>
                            <li class="nav-item">
                                <a href="{{route('pengeluaran.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-money-check" style="color: white;"></i>
                                    <p style="color: white; font-weight: 900;">
                                        Pengeluaran
                                    </p>
                                </a>
                            </li>
                        @endcan -->
                        @can('manage pembelian')
                            <li class="nav-header" style="color: white;">TRANSAKSI</li>
                            <li class="nav-item">
                                <a href="{{route('pembelian.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-download" style="color: white;"></i>
                                    <p style="color: white; font-weight: 900;">
                                        Pembelian
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @unless(auth()->user()->hasRole('admin'))
                            @can('manage penjualan')
                                <li class="nav-item">
                                    <a href="{{ route('penjualan.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-upload" style="color: white;"></i>
                                        <p style="color: white; font-weight: 900;">
                                            Penjualan
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        @endunless
                        <!-- <li class="nav-item">
                            <a href="{{ route('transaksi.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-cart-arrow-down" style="color: white;"></i>
                                <p style="color: white; font-weight: 900;">
                                    Transaksi Lama
                                </p>
                            </a>
                        </li> -->
                        @unless(auth()->user()->hasRole('admin'))
                            @can('manage penjualan')
                                <li class="nav-item">
                                    <a href="{{ route('transaksi.baru') }}" class="nav-link">
                                        <i class="nav-icon fas fa-shopping-cart" style="color: white;"></i>
                                        <p style="color: white; font-weight: 900;">
                                            Transaksi
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        @endunless

                        @can('manage laporan')
                            <li class="nav-header" style="color: white;">REPORT</li>
                            <li class="nav-item">
                                <a href="{{ route('laporan.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-file-pdf" style="color: white;"></i>
                                    <p style="color: white; font-weight: 900;">
                                        Laporan
                                    </p>
                                </a>
                            </li>
                        @endcan
                        <!-- <li class="nav-header" style="color: white;">SYSTEM</li>
                        <li class="nav-item">
                            <a href="/supplier" class="nav-link">
                                <i class="nav-icon fas fa-user" style="color: white;"></i>
                                <p style="color: white; font-weight: 900;">
                                    User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/supplier" class="nav-link">
                                <i class="nav-icon fas fa-cogs" style="color: white;"></i>
                                <p style="color: white; font-weight: 900;">
                                    Pengaturan
                                </p>
                            </a>
                        </li> -->

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        <footer class="main-footer" style="background-color: #d3d3d3;">
            <strong style="color: black; font-weight: bold;">Copyright &copy; 2024 - <a href="https://adminlte.io"
                    style="color: black;">Apotik Nurani</a>.</strong>
            <div class="float-right d-none d-sm-inline-block" style="color: black; font-weight: bold;">
                <b>All rights reserved.</b>
            </div>

        </footer>


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('template/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('template/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('template/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('template/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('template/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('template/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('template/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('template/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{ asset('template/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('template/dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('template/dist/js/pages/dashboard.js')}}"></script>
    <script src="{{ asset('js/validator.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    @stack('scripts')
</body>

</html>