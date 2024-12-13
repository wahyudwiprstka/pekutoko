@extends('admin._layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-12">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Produk UMKM</p>
                                <h4 class="my-1 text-info">{{ $countProduct }}</h4>
                                <!-- <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>+2.5% dari minggu lalu</p> -->
                            </div>
                            <div class="widgets-icons rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Seluruh Order</p>
                                <h4 class="my-1 text-info">{{ $countOrders }}</h4>
                                <!-- <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>+2.5% dari minggu lalu</p> -->
                            </div>
                            <div class="widgets-icons rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Order Belum Diproses</p>
                                <h4 class="my-1 text-info">{{ $orderBelumProses }}</h4>
                                <!-- <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>+2.5% dari minggu lalu</p> -->
                            </div>
                            <div class="widgets-icons rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Order Sedang Dikirim</p>
                                <h4 class="my-1 text-info">{{ $orderSedangKirim }}</h4>
                                <!-- <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>+2.5% dari minggu lalu</p> -->
                            </div>
                            <div class="widgets-icons rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Order Berhasil</p>
                                <h4 class="my-1 text-info">{{ $ordersBerhasil }}</h4>
                                <!-- <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>+2.5% dari minggu lalu</p> -->
                            </div>
                            <div class="widgets-icons rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Pendapatan</p>
                                <h4 class="my-1 text-info">{{ 'Rp ' . number_format($countPendapatan->pendapatan, 0, ',', '.') }}</h4>
                                <!-- <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>+2.5% dari minggu lalu</p> -->
                            </div>
                            <div class="widgets-icons rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="chart">
            <h3 class="text-center">Pendapatan UMKM per Tahun</h3>
            <canvas id="chartPendapatan"></canvas>
        </div>
        <div class="chart mt-4">
            <h3 class="text-center">Jumlah Order per Tahun</h3>
            <canvas id="chartOrder"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
<script>
    var ctx = document.getElementById("chartPendapatan").getContext("2d");
    var chartPendapatan = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: {!! json_encode($datasets) !!},
        }
    })

    var ctxOrder = document.getElementById("chartOrder").getContext("2d");
    var chartOrder = new Chart(ctxOrder, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: {!! json_encode($datasetsOrder) !!},
        }
    })
</script>
@endsection