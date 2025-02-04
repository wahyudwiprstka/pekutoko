@extends('landing._layout.app')

@section('title', 'Order')

@section('content')
  <div class="container d-flex flex-column justify-content-center align-items-center" style="gap: 10px">

    @php
      $notfound = null;
    @endphp 

    @if($notfound)
    <div class="alert alert-danger w-50 m-auto mb-2" role="alert">
      {{$notfound}}
    </div>
    @endif
    <div class="card w-50 m-auto">
      <div class="card-body">
        <form action="/order/search">
          <div class="mb-3">
            <label for="phonenumber" class="form-label">Nomor HP</label>
            <input type="text" class="form-control" id="phonenumber" name="phonenumber">
          </div>
          <div class="mb-3">
            <label for="order_number" class="form-label">Nomor Order</label>
            <input type="text" class="form-control" id="order_number" name="order_number">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
    
    
  </div>
@endsection
