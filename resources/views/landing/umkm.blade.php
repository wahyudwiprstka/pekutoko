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
                        <span>Semua UMKM</span>
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
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>UMKM Terdaftar</h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter">

            @if (count($ukm) != 0)
            @foreach ($ukm as $list)
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <img class="featured__item__pic set-bg" src="{{ asset('assets/landing/img/shop.png') }}"/>
                    <div class="featured__item__text">
                        <h6><a href="{{ route('landing.umkm', ['id' => $list->id]) }}">{{ $list->ukm_name }}</a></h6>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-lg-12">
                <div class="alert alert-danger" role="alert">
                    UMKM tidak ditemukan
                </div>
            </div>
            @endif


        </div>
    </div>
</section>
@endsection