<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>UMKM Pekutatan</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('assets/landing/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/style.css') }}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="header__top__right">
                            <div class="header__top__right__auth">
                                <a href="{{route('login')}}"><i class="fa fa-user"></i> Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="{{ Request::routeIs(['landing']) ? 'active' : '' }}"><a href="{{ route('landing') }}">Home</a></li>
                            <li class="{{ Request::routeIs(['landing.umkm']) ? 'active' : '' }}"><a href="{{ route('landing.umkm') }}">UMKM</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            @php
                            $cart = session()->get('cart', []);
                            $cartCount = count($cart);

                            @endphp
                            <li><a href="{{ route('landing.show-cart') }}"><i class="fa fa-shopping-bag"></i> <span>{{ $cartCount }}</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    @yield('content')

    <!-- Banner End -->

    <!-- Footer Section Begin -->
    <footer style="background-color: #4f46e5; margin-top: 50px">
        <div style="padding: 30px 0">
            <div style="padding: 0 400px">
                <h5 class="fw-bold" style="color: white; font-weight: 700">Tentang Pekutoko</h5>
                <p style="color: white; text-align: justify; text-justify: inter-word; margin: 0">
                    Pekutoko adalah sebuah platform marketplace yang didirikan untuk mendukung dan memajukan UMKM, khususnya di desa Pekutatan. Marketplace ini dikelola langsung oleh pihak desa, dengan tujuan utama untuk memberikan akses kepada para pelaku UMKM di desa tersebut untuk memasarkan produk mereka ke pasar yang lebih luas, baik secara online maupun offline. <br>

    Konsep utama dari Pekutoko adalah memberikan ruang bagi usaha kecil dan menengah di desa untuk tumbuh dan berkembang, dengan memanfaatkan teknologi digital untuk mengakses pasar yang sebelumnya mungkin sulit dijangkau. Sebagai platform yang dikelola oleh desa, Pekutoko tidak hanya fokus pada transaksi jual-beli, tetapi juga pada pemberdayaan ekonomi lokal dengan memberikan pelatihan, penguatan kapasitas, dan akses ke sumber daya yang diperlukan oleh UMKM.
    <br>

    Untuk cara pembelian produk bisa dilihat <a href="{{route('landing.caraPembelian')}}">disini</a>
                </p>
            </div>
            <hr style="width: 70%; color:white; background-color: white;"/>
            <div style="padding: 0 400px">
                <p style="color: white; text-align: center;">Made with 🤍 by Pekutoko</p>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('assets/landing/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('assets/landing/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/main.js') }}"></script>
</body>

</html>