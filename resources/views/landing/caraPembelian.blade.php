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
                            <h5>081246241129</h5>
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
        <h3 class="mb-2">Cara Pembelian</h3>
        <h5>1. Pilih produk yang akan dibeli</h5>
        <h5>2. Masukkan produk ke keranjang</h5>
        <h5>3. Jika ingin membeli produk lain, pilih "Continue Shopping"</h5>
        <h5>4. Jika sudah selesai, pergi ke halaman "Cart" dan klik "Proceed Checkout"</h5>
        <h5>5. Pilih metode pembayaran dan bayar</h5>
        <h5>6. Jika pembayaran berhasil, pembeli akan diberikan notifikasi lewat WhatsApp</h5>
        <h5>7. Penjual akan mengirim produk langsung ke rumah pembeli.</h5>
    </div>
</section>
@endsection