@extends('admin._layout.app')

@section('title', 'Order')

@section('content')
<div class="page-wrapper">
  <div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Order</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">List Order</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <form class="date__sort">
            <div>
                <label for="tanggal_awal">Tanggal Awal:</label>
                <input type="date" id="tanggal_awal" name="tanggal_awal" class="sort_tanggal" required/>
              </div>
              <div>
                <label for="tanggal_akhir">Tanggal Akhir:</label>
                <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="sort_tanggal" required/>
              </div>
              <button type="submit" class="btn-primary">Submit</button>
            </form>
          <table id="order-table" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>Aksi</th>
                <th>No Order</th>
                <th>Nama UMKM</th>
                <th>Nama Pembeli</th>
                <th>Total Pembelian</th>
                <th>Tanggal</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $list)
              <tr>
                <td>
                  <a href="{{ route('order.show', [$list->id]) }}">
                    <button type="button" class="btn btn-primary btn-sm">Detail</button>
                  </a>
                </td>
                <td>{{ $list->order_number }}</td>
                <td>{{ $list->ukm->ukm_name }}</td>
                <td>{{ $list->full_name }}</td>
                <td>{{ 'Rp ' . number_format($list->total_price, 0, ',', '.') }}</td>
                <td>{{ $list->created_at->format('d M Y') }}</td>
                <td>{{ $list->getOrderStatusText() }}</td>
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

@push('script')
<script>
  $(document).ready(function() {
    $('#order-table').DataTable();
  });
</script>

@endpush