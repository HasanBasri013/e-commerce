<aside class="main-sidebar bg-white">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Admin Kasir</span>
    </a>

    <!-- Sidebar Menu -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard Link -->
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Master Dropdown Menu -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa fa-server"></i>
                        <p>Master <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.component.uploadbarang')}}" class="nav-link">
                                <i class="nav-icon fa fa-boxes-stacked"></i>
                                <p>Master Item</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('component.supplier') }}" class="nav-link">
                                <i class="nav-icon fa fa-address-book"></i>
                                <p>Master Supplier</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('component.customer') }}" class="nav-link">
                                <i class="nav-icon fa fa-address-book"></i>
                                <p>Master cusomer</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Laporan Jual Link -->
                <li class="nav-item has-treeview">
                    {{-- <a href="#" class="nav-link">
                        <i class="nav-icon fas fa fa-server"></i>
                        <p>Master <i class="right fas fa-angle-left"></i></p>
                    </a> --}}
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-bag-shopping"></i>
                        <p>Purchase<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('transaksi.po') }}" class="nav-link">
                                <i class="nav-icon fa fa-boxes-stacked"></i>
                                <p>Purchase Oreder</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Kartu Stok Item Link -->
                <li class="nav-item">
                    <a href="?page=kartu_stok" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Kartu Stok Item</p>
                    </a>
                </li>

                <!-- Settings Link -->
      
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Settings <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('banners.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-image"></i> <!-- Updated icon -->
                                <p>Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('upload.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-upload"></i> <!-- Updated icon -->
                                <p>Upload Gambar</p>
                            </a>
                        </li>
                    </ul>
                    
            </ul>
        </nav>
    </div>
    
</aside>
