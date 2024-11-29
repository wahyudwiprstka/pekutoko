@extends('landing._layout.app')

@section('content')
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
<section class="cara__pembelian" style="min-height: 80%">
    <div class="container">
        <h3>Cara Pembelian</h3>
    </div>
</section>
@endsection