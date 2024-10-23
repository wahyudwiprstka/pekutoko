@extends('admin._layout.app')

@section('title', 'UKM')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Pengguna</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Pengguna</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Form Tambah Pengguna</h5>
                        <form class="needs-validation" id="createUserForm" novalidate>
                            <div class="row mb-3">
                                <label for="inputUkmName" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputUkmName" name="name" placeholder="Masukkan Nama pengguna" required>
                                    <div class="invalid-feedback" id="name-error"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputIdentity" class="col-sm-3 col-form-label">No KTP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputIdentity" name="identity_number" placeholder="Masukkan No KTP" required>
                                    <div class="invalid-feedback" id="identity_number-error"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputUkmName" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputUkmName" name="password">
                                    <div class="invalid-feedback" id="password-error"></div>
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

        $('#createUserForm').submit(function(e) {
            e.preventDefault(); // Menghentikan pengiriman form bawaan browser

            // Mengambil nilai form
            var formData = $(this).serialize();

            // Kirim data menggunakan AJAX
            $.ajax({
                type: 'POST',
                url: '/admin/users/store', // Ganti dengan URL tujuan pengiriman data
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
                        $('#identity_number-error').text(errors.identity_number ? errors.identity_number[0] : '');
                        $('#password-error').text(errors.password ? errors.password[0] : '');
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