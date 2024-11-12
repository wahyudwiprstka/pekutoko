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
          <h2>Shopping Cart</h2>
          <div class="breadcrumb__option">
            <a href="./index.html">Home</a>
            <span>Shopping Cart</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="shoping__cart__table">
          <table>
            <thead>
              <tr>
                <th class="shoping__product">Products</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $list )
              <tr>
                <td class="shoping__cart__item">
                  @php
                  $file = File::where('model_id', $list->id)->where('model', 'products')->first();
                  @endphp
                  <img src="{{ asset($file->filename) }}" alt="" height="80">
                  <h5>{{$list->product_name}}</h5>
                </td>
                <td class="shoping__cart__price">
                Rp {{ number_format($list->price, 0, ',', '.') }}
                </td>
                <td class="shoping__cart__quantity">
                  <div class="quantity">
                  {{ $list->quantity }}
                  </div>
                </td>
                <td class="shoping__cart__total">
                Rp {{ number_format($list->price * $list->quantity, 0, ',', '.') }}
                </td>
                <td class="shoping__cart__item__close">
                  <a href="{{ route('landing.remove-cart-product', ['id' => $list->id]) }}">
                    <span class="icon_close"></span>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="shoping__cart__btns">
          <a href="{{ route('landing') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="shoping__checkout">
          <h5>Cart Total</h5>
          <ul>
            <li>Total <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span></li>
          </ul>
          <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Shoping Cart Section End -->
@endsection

