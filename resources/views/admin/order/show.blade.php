@extends('admin._layout.app')

@section('title', 'Detail Order')
@php
use App\Models\File;
@endphp
@section('content')
<div class="page-wrapper">
  <div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Detail Order</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detail Order</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h5>Data Pembeli</h5>
        <div class="buyer-data">
          <p><strong>Nama:</strong> {{ $order->full_name }}</p>
          <p><strong>Alamat:</strong> {{ $order->address }}</p>
          <p><strong>Kabupaten:</strong> {{ $order->regency }}</p>
          <p><strong>Kode Pos:</strong> {{ $order->postal_code }}</p>
          <p><strong>No. Telepon:</strong> {{ $order->phone_number }}</p>
          <p><strong>Email:</strong> {{ $order->email }}</p>
          <p><strong>Catatan:</strong> {{ $order->notes }}</p>

          <p><strong>Status Order:</strong> {{ $order->getOrderStatusText() }}</p>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-body">

        <!-- add title -->

        <h5>List Produk yang Di Beli</h5>

        <div class="table-responsive">
          <table id="order_detail-table" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th colspan="2">Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $list)
              <tr>
                <td>
                  @php
                  $file = File::where('model_id', $list['product_id'])->where('model', 'products')->first();
                  @endphp
                  <img src="{{ asset($file->filename) }}" alt="" height="80">
                </td>
                <td>{{ $list['name'] }}</td>
                <td>{{ $list['price'] }}</td>
                <td>{{ $list['quantity'] }}</td>
                <td>{{ 'Rp ' . number_format($list['total_price'], 0, ',', '.') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>
</div>

@endsection