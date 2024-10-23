<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/admin/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/admin/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/admin/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/admin/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/icons.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UMKM Pekutatan Admin</title>
</head>

<body class="">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-4">
                                    <!-- <div class="mb-3 text-center">
                                        <img src="assets/images/logo-icon.png" width="60" alt="" />
                                    </div> -->
                                    <div class="text-center mb-4">
                                        <h5 class="">UMKM ADMIN</h5>
                                        <p class="mb-0">Silakan login menggunakan akun anda</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" id="loginForm">
                                            <div class="col-12">
                                                <label for="inputIdentityNumber" class="form-label">NIK</label>
                                                <input type="number" class="form-control" id="inputIdentityNumber" name="identity_number" placeholder="Masukkan NIK" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" placeholder="Masukkan Password" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Login</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#loginForm').submit(function(e) {
                e.preventDefault(); // Menghentikan pengiriman form bawaan browser

                // Mengambil nilai form
                var formData = $(this).serialize();

                // Kirim data menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: '/login-proccess', // Ganti dengan URL tujuan pengiriman data
                    data: formData,
                    success: function(response) {
                        // Handle respon dari server
                        // console.log(response);
                        if (response.code == 200) {
                            window.location.href = response.url;
                        } else {
                            Swal.fire({
                                title: 'Kesalahan!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'Tutup'
                            })
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                        Swal.fire({
                            title: 'Kesalahan!',
                            text: 'Terjadi Kesalahan Dalam Sistem',
                            icon: 'error',
                            confirmButtonText: 'Tutup'
                        })
                    }
                });
            });
        });
    </script>
</body>

</html>