<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"
                    onerror="this.src='{{ asset('AdminLTE-2/dist/img/default-user.png') }}';">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <!-- <li class="active treeview">
                <a href="/">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li> -->
            <!-- <li class="header">MASTER</li>
            <li>
                <a href="{{ route('kategori.index') }}">
                    <i class="fa fa-cube"></i>
                    <span>Kategori</span>
                </a>
            </li>
            <li>
                <a href="{{ route('produk.index') }}">
                    <i class="fa fa-cubes"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li>
                <a href="{{route('member.index')}}">
                    <i class="fa fa-id-card"></i>
                    <span>Member</span>
                </a>
            </li>
            <li>
                <a href="{{route('supplier.index')}}">
                    <i class="fa fa-truck"></i>
                    <span>Supplier</span>
                </a>
            </li> -->
            <li class="header">TRANSAKSI</li>
            <!-- <li>
                <a href="{{route('pengeluaran.index')}}">
                    <i class="fa fa-money"></i>
                    <span>Pengeluaran</span>
                </a>
            </li>
            <li>
                <a href="{{route('pembelian.index')}}">
                    <i class="fa fa-download"></i>
                    <span>Pembelian</span>
                </a>
            </li> -->
            @unless(auth()->user()->hasRole('admin'))
                @can('manage penjualan')
                    <li class="nav-item">
                        <a href="{{ route('penjualan.index') }}" class="nav-link">
                            <i class="fa fa-upload"></i>
                            <span>Penjualan</span>
                        </a>
                    </li>
                @endcan
            @endunless
            <!-- <li>
                <a href="#">
                    <i class="fa fa-cart-arrow-down"></i>
                    <span>Transaksi Lama</span>
                </a>
            </li> -->
            @unless(auth()->user()->hasRole('admin'))
                @can('manage penjualan')
                    <li class="nav-item">
                        <a href="{{ route('transaksi.baru') }}" class="nav-link">
                            <i class="fa fa-cart-arrow-down"></i>
                            <span>Transaksi</span>
                        </a>
                    </li>
                @endcan
            @endunless
            <!-- <li class="header">REPORT</li>
            <li>
                <a href="#">
                    <i class="fa fa-file-pdf-o"></i>
                    <span>Laporan</span>
                </a>
            </li>
            <li class="header">SYSTEM</li>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>User</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Pengaturan</span>
                </a>
            </li> -->
        </ul>
    </section>
</aside>