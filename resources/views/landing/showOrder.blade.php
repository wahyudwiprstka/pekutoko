@extends('landing._layout.app')

@section('title', 'Detail Order')
@php
use App\Models\File;
@endphp
@section('content')
<div class="page-wrapper container">
  <div class="page-content">

    <div class="card mb-2">
      <div class="card-body">
        <h5 class="mb-2">Data Pembeli</h5>
        <div class="buyer-data">
          <p><strong>Nama:</strong> {{ $orders[0]->full_name }}</p>
          <p><strong>Alamat:</strong> {{ $orders[0]->address }}</p>
          <p><strong>Kabupaten:</strong> {{ $orders[0]->regency }}</p>
          <p><strong>Kode Pos:</strong> {{ $orders[0]->postal_code }}</p>
          <p><strong>No. Telepon:</strong> {{ $orders[0]->phone_number }}</p>
          <p><strong>Email:</strong> {{ $orders[0]->email }}</p>
          <p><strong>Catatan:</strong> {{ $orders[0]->notes }}</p>

          <p><strong>Status Order:</strong> {{ $orders[0]->getOrderStatusText() }}</p>
          <!-- add button sending order if order_status == 1 -->

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
              @foreach($products as $product)
                @foreach($product as $list)   
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
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>
</div>

@endsection

@push('script')
<script>
  function updateOrder(orderId) {
    Swal.fire({
      title: 'Apakah Anda yakin?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yakin',
      cancelButtonText: 'Tidak Yakin'
    }).then((result) => {
      // send to server
      if (result.isConfirmed) {
        // Submit the form programmatically
        document.getElementById('orderForm-' + orderId).submit();
      }
    });
  }

  function batalOrder(orderId) {
    Swal.fire({
      title: 'Apakah Anda yakin?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yakin',
      cancelButtonText: 'Tidak Yakin'
    }).then((result) => {
      // send to server
      if (result.isConfirmed) {
        // Submit the form programmatically
        document.getElementById('cancelForm-' + orderId).submit();
      }
    });
  }
  </script>
@endpush