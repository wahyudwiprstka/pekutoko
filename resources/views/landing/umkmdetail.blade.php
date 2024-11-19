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

<section class="featured spad">
    <div class="container">
        <div class="card umkm__card">
            <div class="umkm__card__div">
                <img class="umkm__card__img" src="{{ asset('assets/landing/img/shop.png') }}"/> 
                <div class="umkm__card__info">
                    <h3>{{$ukm->ukm_name}}</h3>
                    <h5>{{$ukm->ukm_address}}</h5>
                    <h5>{{$ukm->wa_pic}}</h5>
                    <button class="umkm__card__btn"><a href="">Hubungi penjual</a></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Produk UMKM ini</h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter">

            @if (count($products) != 0)
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
            @else
            <div class="col-lg-12">
                <div class="alert alert-danger" role="alert">
                    Produk tidak ditemukan
                </div>
            </div>
            @endif


        </div>
    </div>
</section>
@endsection 