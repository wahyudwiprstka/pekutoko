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
                                <p class="mb-0 text-secondary">Total UMKM Terdaftar</p>
                                <h4 class="my-1 text-info">{{ $countUkm }}</h4>
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
        </div><!--end row-->
    </div>
</div>
@endsection