@extends('landing._layout.app')

@section('content')
@php
use App\Models\File;
@endphp
<section class="hero hero-normal">
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
                            <h5>085123456789</h5>
                            <span>Support 24 Jam</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        @php
                        $file = File::where('model_id', $product->id)->where('model', 'products')->first();
                        @endphp

                        <img class="product__details__pic__item--large" src="{{ asset($file->filename) }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product->product_name }}</h3>
                    <h5>{{ $product->ukm->ukm_name }} UMKM</h5>
                    <div class="product__details__price">{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</div>
                    <p>{{ $product->description }}</p>
                    <a href="{{$whatsappUrl}}" class="primary-btn">Hubungi Penjual</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Produk Lainnya</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="categories__slider owl-carousel">

                @foreach ($products as $list)

                @php
                $file = File::where('model_id', $list->id)->where('model', 'products')->first();
                @endphp

                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{ asset($file->filename) }}">
                        <h5><a href="{{ route('landing.detail', ['id' => $list->id]) }}">{{$list->product_name}}</a></h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Related Product Section End -->
<!-- Product Details Section End -->
@endsection