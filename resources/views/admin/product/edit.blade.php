@extends('admin._layout.app')

@section('title', 'UKM')

@section('content')

@php
$session = session('userRole');
@endphp
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Produk</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Form Edit Produk UMKM</h5>
                        <form class="needs-validation" id="updateProductForm" enctype="multipart/form-data" novalidate>
                            <div class="row mb-3">
                                <label for="inputUkmName" class="col-sm-3 col-form-label">Nama Produk</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputUkmName" name="product_name" value="{{ $product->product_name }}" placeholder="Masukkan Nama Produk" {{ $session !== 'ukm' ? 'disabled' : '' }} required>
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div class="invalid-feedback" id="product_name-error"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputIdentity" class="col-sm-3 col-form-label">Kategori Produk</label>
                                <div class="col-sm-9">
                                    <select class="form-select mb-3" name="id_category" aria-label="Default select example" {{ $session !== 'ukm' ? 'disabled' : '' }} required>
                                        <option value="{{ $product->category->id }}">{{ $product->category->category_name }}</option>
                                        @foreach($categories as $category)
                                        @if($product->category->id !== $category->id)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputIdentity" class="col-sm-3 col-form-label">Satuan Produk</label>
                                <div class="col-sm-9">
                                    <select class="form-select mb-3" name="id_satuan" aria-label="Default select example" {{ $session !== 'ukm' ? 'disabled' : '' }} required>
                                        <option value="{{ $product->satuan->id }}">{{ $product->satuan->name }}</option>
                                        @foreach($satuan as $list)
                                        @if($product->satuan->id !== $list->id)
                                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputUkmName" class="col-sm-3 col-form-label">Jumlah Jual Persatuan</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="inputUkmName" name="jml_jual_per_satuan" value="{{ $product->jml_jual_per_satuan }}" placeholder="Jumlah Produk Per Satuan" {{ $session !== 'ukm' ? 'disabled' : '' }} required>
                                    <div class="invalid-feedback" id="price-error"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputIdentity" class="col-sm-3 col-form-label">Deskripsi Produk</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="input11" name="description" placeholder="Masukkan deskripsi produk ..." rows="3" {{ $session !== 'ukm' ? 'disabled' : '' }}>{{ $product->description }}</textarea>
                                    <div class="invalid-feedback" id="description-error"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputUkmName" class="col-sm-3 col-form-label">Harga Produk</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="inputUkmName" name="price" value="{{ $product->price }}" placeholder="Harga Produk" {{ $session !== 'ukm' ? 'disabled' : '' }} required>
                                    <div class="invalid-feedback" id="price-error"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Upload Gambar Produk</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" name="file" accept=".jpg, .png, image/jpeg, image/png" {{ $session !== 'ukm' ? 'disabled' : '' }} multiple>
                                    <div class="invalid-feedback" id="file-error"></div>
                                    @if($file)
                                    <div>
                                        <figure>
                                            <img src="{{ asset($file->filename) }}" alt="Gambar Produk" style="max-width: 200px; max-height: 200px;">
                                            <figcaption>Gambar Saat ini</figcaption>
                                        </figure>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        @if(session('userRole') == 'ukm')
                                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#updateProductForm').submit(function(e) {
            e.preventDefault(); // Menghentikan pengiriman form bawaan browser

            // Mengambil nilai form
            var formData = new FormData($('#updateProductForm')[0]);

            // Kirim data menggunakan AJAX
            $.ajax({
                type: 'POST',
                url: '/admin/product/update', // Ganti dengan URL tujuan pengiriman data
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle respon dari server
                    // console.log(response);
                    if (response.code == 200) {
                        Swal.fire({
                            title: 'Sukses',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Tutup'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Kesalahan!',
                            text: 'Terjadi Kesalahan',
                            icon: 'error',
                            confirmButtonText: 'Tutup'
                        })
                        var errors = response.errors;
                        console.log(errors);
                        // Tampilkan pesan error validasi
                        $('#product_name-error').text(errors.name ? errors.name[0] : '');
                        $('#price-error').text(errors.identity_number ? errors.identity_number[0] : '');
                        $('#description-error').text(errors.ukm_name ? errors.ukm_name[0] : '');
                        $('#file-error').text(errors.ukm_address ? errors.ukm_address[0] : '');
                        $('#jml_jual_per_satuan-error').text(errors.jml_jual_per_satuan ? errors.jml_jual_per_satuan[0] : '');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    // sweetalert

                    Swal.fire({
                        title: 'Kesalahan!',
                        text: 'Terjadi Kesalahan',
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    })

                }
            });
        });
    });
</script>
@endpush