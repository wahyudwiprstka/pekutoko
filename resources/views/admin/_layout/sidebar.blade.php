<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/admin/images/pekutoko.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Pekutoko</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if (session('userRole') == 'admin' || session('userRole') == 'superadmin')
        <li class="{{ Request::routeIs(['dashboard']) ? 'mm-active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Master Data</div>
            </a>
            <ul>
                <li class="{{ Request::routeIs(['category']) ? 'mm-active' : '' }}">
                    <a href="{{ route('category') }}"><i class='bx bx-radio-circle'></i>Kategori Barang</a>
                </li>
            </ul>
            <ul>
                <li class="{{ Request::routeIs(['satuan']) ? 'mm-active' : '' }}">
                    <a href="{{ route('satuan') }}"><i class='bx bx-radio-circle'></i>Satuan Barang</a>
                </li>
            </ul>
        </li>
        <li class="{{ Request::routeIs(['ukm']) ? 'mm-active' : '' }}">
            <a href="{{ route('ukm') }}">
                <div class="parent-icon"><i class='bx bx-store'></i>
                </div>
                <div class="menu-title">UMKM</div>
            </a>
        </li>
        @endif


        <li class="{{ Request::routeIs(['product']) ? 'mm-active' : '' }}">
            <a href="{{ route('product') }}">
                <div class="parent-icon"><i class='bx bx-box'></i>
                </div>
                <div class="menu-title">Produk</div>
            </a>
        </li>

        @if (session('userRole') == 'superadmin')
        <li class="{{ Request::routeIs(['users']) ? 'mm-active' : '' }}">
            <a href="{{ route('users') }}">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Pengguna</div>
            </a>
        </li>
        @endif

        <li class="{{ Request::routeIs(['order']) ? 'mm-active' : '' }}">
            <a href="{{ route('order') }}">
                <div class="parent-icon"><i class='bx bx-shopping-bag'></i>
                </div>
                <div class="menu-title">Order</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>