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

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('assets/landing/img/breadcrumb.jpg')}}">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Checkout</h2>
          <div class="breadcrumb__option">
            <a href="./index.html">Home</a>
            <span>Checkout</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
  <div class="container">
    <div class="checkout__form">
      <h4>Billing Details</h4>
      <form action="{{ route('landing.process-checkout') }}" method="post">
        @csrf
        <div class="row">
          <div class="col-lg-8 col-md-6">
            <div class="checkout__input">
              <p>Nama Lengkap<span>*</span></p>
              <input type="text" name="full_name" placeholder="Masukkan Nama Lengkap" required>
            </div>
            <div class="checkout__input">
              <p>Alamat<span>*</span></p>
              <input type="text" name="address" placeholder="Masukkan Alamat Lengkap" class="checkout__input__add" required>
            </div>
            <div class="checkout__input">
              <p>Kabupaten<span>*</span></p>
              <input type="text" name="regency" value="Jembrana" readonly>
              <small style="color: red; font-size: 0.9em;">Saat ini Pekutoko hanya melayani pengiriman/order di wilayah kabupaten Jembrana</small>
            </div>
            <div class="checkout__input">
              <p>Kode POS<span>*</span></p>
              <input type="text" name="postal_code" placeholder="Masukkan Kode POS" required>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="checkout__input">
                  <p>Nomor HP / WA<span>*</span></p>
                  <input type="text" name="phone_number" placeholder="Masukkan Nomor HP" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="checkout__input">
                  <p>Email<span>*</span></p>
                  <input type="text" name="email" placeholder="Masukkan Email" required>
                </div>
              </div>
            </div>
            <div class="checkout__input">
              <p>Tambahkan Catatan<span> (opsional)</span></p>
              <input type="text" name="notes"
                placeholder="Notes about your order, e.g. special notes for delivery.">
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="checkout__order">
              <h4>Your Order</h4>
              <div class="checkout__order__products">Products <span>Total</span></div>
              <ul>
                @foreach ($products as $product)
                <li>{{ $product->product_name }} x {{ $product->quantity }} <span>Rp {{ number_format($product->price * $product->quantity, 0, ',', '.') }}</span></li>
                @endforeach
              </ul>
              <div class="checkout__order__total">Total <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span></div>
              <button type="submit" class="site-btn">PLACE ORDER</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- Checkout Section End -->
@endsection
