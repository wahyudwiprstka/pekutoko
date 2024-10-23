@extends('admin._layout.app')

@section('title', 'UKM')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">UKM</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit UKM</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Form Edit UKM</h5>
                        <form class="needs-validation" id="updateUkmForm" novalidate>
                            <input type="hidden" class="form-control" value="{{ $ukm->id }}" name="id_ukm">
                            <input type="hidden" class="form-control" value="{{ $ukm->user->id }}" name="id_user">
                            <div class="row mb-3">
                                <label for="inputUkmName" class="col-sm-3 col-form-label">Nama Pemilik UKM</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputUkmName" value="{{ $ukm->user->name }}" name="name" placeholder="Masukkan Nama Pemilik UKM" required>
                                    <div class="invalid-feedback" id="name-error"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputIdentity" class="col-sm-3 col-form-label">No KTP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputIdentity" value="{{ $ukm->user->identity_number }}" name="identity_number" placeholder="Masukkan No KTP" required>
                                    <div class="invalid-feedback" id="identity_number-error"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputUkmName" class="col-sm-3 col-form-label">Nama UKM</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputUkmName" value="{{ $ukm->ukm_name }}" name="ukm_name" placeholder="Masukkan Nama UKM" required>
                                    <div class="invalid-feedback" id="ukm_name-error"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputUkmAddress" class="col-sm-3 col-form-label">Alamat UKM</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputUkmAddress" value="{{ $ukm->ukm_address }}" name="ukm_address" placeholder="Masukkan Alamat UKM" required>
                                    <div class="invalid-feedback" id="ukm_address-error"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputWaPic" class="col-sm-3 col-form-label">Nomor WA UKM</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputWaPic" value="{{ $ukm->wa_pic }}" name="wa_pic" placeholder="Masukkan Nomor WA UKM" required>
                                    <div class="invalid-feedback" id="wa_pic-error"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputEmail" value="{{ $ukm->ukm_email }}" name="ukm_email" placeholder="Masukkan Email UKM" required>
                                    <div class="invalid-feedback" id="ukm_email-error"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-select mb-3" aria-label="Default select example" name="ukm_status">
                                        <?php if ($ukm->ukm_status == 1) : ?>
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        <?php else : ?>
                                            <option value="1">Aktif</option>
                                            <option value="0" selected>Tidak Aktif</option>
                                        <?php endif; ?>
                                    </select>
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

        $('#updateUkmForm').submit(function(e) {
            e.preventDefault(); // Menghentikan pengiriman form bawaan browser

            // Mengambil nilai form
            var formData = $(this).serialize();

            // Kirim data menggunakan AJAX
            $.ajax({
                type: 'POST',
                url: '/admin/umkm/update', // Ganti dengan URL tujuan pengiriman data
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
                        $('#ukm_name-error').text(errors.ukm_name ? errors.ukm_name[0] : '');
                        $('#ukm_address-error').text(errors.ukm_address ? errors.ukm_address[0] : '');
                        $('#wa_pic-error').text(errors.wa_pic ? errors.wa_pic[0] : '');
                        $('#ukm_email-error').text(errors.ukm_email ? errors.ukm_email[0] : '');
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