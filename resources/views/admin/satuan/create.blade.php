@extends('admin._layout.app')

@section('title', 'Kategori')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Satuan Barang</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Satuan Barang</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Form Tambah Satuan Barang</h5>
                        <form class="needs-validation" id="createSatuanForm" novalidate>
                            <div class="row mb-3">
                                <label for="inputSatuanName" class="col-sm-3 col-form-label">Nama Satuan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputSatuanName" name="name" placeholder="Masukkan Nama Satuan" required>
                                    <div class="invalid-feedback" id="name-error"></div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
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

        $('#createSatuanForm').submit(function(e) {
            e.preventDefault(); // Menghentikan pengiriman form bawaan browser

            // Mengambil nilai form
            var formData = $(this).serialize();

            // Kirim data menggunakan AJAX
            $.ajax({
                type: 'POST',
                url: '/admin/satuan/store', // Ganti dengan URL tujuan pengiriman data
                data: formData,
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
                        var errors = response.errors;
                        console.log(errors);
                        // Tampilkan pesan error validasi
                        $('#name-error').text(errors.name ? errors.name[0] : '');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);

                }
            });
        });
    });
</script>
@endpush