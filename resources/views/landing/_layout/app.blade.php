<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                            <li class="active"><a href="{{ route('landing') }}">Home</a></li>
                            <li><a href="{{ route('landing.umkm') }}">UMKM</a></li>
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
    <footer>

        <div class="col-lg-12">
            <div class="footer__copyright">
                <div class="footer__copyright__text">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy; Wahyu Dwi Prastika <script>
                            document.write(new Date().getFullYear());
                        </script>. All rights reserved</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
                <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
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