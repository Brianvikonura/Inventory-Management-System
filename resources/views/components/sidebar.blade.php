<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            @if (Auth::user()->role == 'superadmin')
                <li class="nav-item nav-profile">
                    <a href="{{ route('home') }}" class="nav-link">
                        <div class="nav-profile-image">
                            <img src="{{ asset('images/faces/avatar.png') }}" alt="profile">
                            <span class="login-status online"></span>
                        </div>
                        <div class="nav-profile-text d-flex flex-column">
                            <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                            <span class="text-secondary text-small">{{ Auth::user()->role }}</span>
                        </div>
                        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <span class="menu-title">Dashboard</span>
                        <i class="mdi mdi-home menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#master-barang" aria-expanded="false"
                        aria-controls="master-barang">
                        <span class="menu-title">Master Barang</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-package menu-icon"></i>
                    </a>
                    <div class="collapse" id="master-barang">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('jenisBarang.index') }}">Jenis</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('satuan.index') }}">Satuan</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('barang.index') }}">Barang</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('customer.index') }}">
                        <span class="menu-title">Customer</span>
                        <i class="mdi mdi-account-group-outline menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ekspedisi.index') }}">
                        <span class="menu-title">Ekspedisi</span>
                        <i class="mdi mdi-account-group-outline menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#transaksi" aria-expanded="false"
                        aria-controls="transaksi">
                        <span class="menu-title">Transaksi</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-cached menu-icon"></i>
                    </a>
                    <div class="collapse" id="transaksi">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('barangmasuk.index') }}">Barang
                                    Masuk</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('barangkeluar.index') }}">Barang
                                    Keluar</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#laporan" aria-expanded="false"
                        aria-controls="laporan">
                        <span class="menu-title">Laporan</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-printer menu-icon"></i>
                    </a>
                    <div class="collapse" id="laporan">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('laporan.barangmasuk.index') }}">Laporan Barang Masuk</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('laporan.barangkeluar.index') }}">Laporan Barang Keluar</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('laporan.stokbarang.index') }}">Laporan Stok Barang</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pengguna.index') }}">
                        <span class="menu-title">Pengguna</span>
                        <i class="mdi mdi-account-search menu-icon"></i>
                    </a>
                </li>
            @elseif (Auth::user()->role == 'admin')
                <li class="nav-item nav-profile">
                    <a href="{{ route('home') }}" class="nav-link">
                        <div class="nav-profile-image">
                            <img src="{{ asset('images/faces/avatar.png') }}" alt="profile">
                            <span class="login-status online"></span>
                            <!--change to offline or busy as needed-->
                        </div>
                        <div class="nav-profile-text d-flex flex-column">
                            <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                            <span class="text-secondary text-small">{{ Auth::user()->role }}</span>
                        </div>
                        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <span class="menu-title">Dashboard</span>
                        <i class="mdi mdi-home menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#master-barang" aria-expanded="false"
                        aria-controls="master-barang">
                        <span class="menu-title">Master Barang</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-package menu-icon"></i>
                    </a>
                    <div class="collapse" id="master-barang">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('jenisBarang.index') }}">Jenis</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('satuan.index') }}">Satuan</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('barang.index') }}">Barang</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('customer.index') }}">
                        <span class="menu-title">Customer</span>
                        <i class="mdi mdi-account-group-outline menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ekspedisi.index') }}">
                        <span class="menu-title">Ekspedisi</span>
                        <i class="mdi mdi-account-group-outline menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#transaksi" aria-expanded="false"
                        aria-controls="transaksi">
                        <span class="menu-title">Transaksi</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-cached menu-icon"></i>
                    </a>
                    <div class="collapse" id="transaksi">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('barangmasuk.index') }}">Barang
                                    Masuk</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('barangkeluar.index') }}">Barang
                                    Keluar</a></li>
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </nav>
