@extends('landing._layout.app')

@section('content')
<!-- Header Section Begin -->
@php
use App\Models\File;
@endphp

<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Semua Kategori</span>
                    </div>
                    <ul>
                        @foreach ($categories as $list)
                        <li><a href="{{ route('landing.category', ['id' => $list->id]) }}">{{ $list->category_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{{ route('landing.search') }}" method="GET">
                            <input type="text" placeholder="What do yo u need?" name="product">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>081246241129</h5>
                            <span>Support 24 Jam</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="{{ asset('assets/landing/img/hero/banner.jpg') }}">
                    <div class="hero__text">
                        <br>
                        <br>
                        <br>
                        <h2>Produk UMKM <br />100% Asli dan Murah</h2>
                        <p>Pengambilan Gratis dan Pengiriman Tersedia</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">

                @foreach ($products as $list)

                @php
                $file = File::where('model_id', $list->id)->where('model', 'products')->first();
                @endphp

                <div class="col-lg-3">
                    <div class="categories__item">
                        <img class="categories__img set-bg" src="{{ asset($file->filename) }}"/>
                        <h5><a href="{{ route('landing.detail', ['id' => $list->id]) }}">{{$list->product_name}}</a></h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Produk</h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter">

            @foreach ($products as $list)

            @php
            $file = File::where('model_id', $list->id)->where('model', 'products')->first();
            @endphp

            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <img class="featured__item__pic set-bg" src="{{ asset($file->filename) }}"/>
                    <div class="featured__item__text">
                        <h6><a href="{{ route('landing.detail', ['id' => $list->id]) }}">{{ $list->product_name }}</a></h6>
                        <h5>{{ 'Rp ' . number_format($list->price, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{ asset('assets/landing/img/banner/banner-1.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{ asset('assets/landing/img/banner/banner-2.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection