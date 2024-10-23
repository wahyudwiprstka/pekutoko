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
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/header-colors.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
    <link href="{{ asset('assets/admin/plugins/fancy-file-uploader/fancy_fileupload.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('css')
    <title>UMKM Pekutatan</title>
</head>

<body>
    {{-- float --}}
    <div class="wrapper">

        {{-- Sidebar --}}
        @include('admin._layout.sidebar')

        {{-- Navbar --}}
        @include('admin._layout.navbar')

        {{-- Content --}}
        @yield('content')


        {{-- Footer --}}
        @include('admin._layout.footer')
    </div>

    {{-- Scripts --}}
    @include('admin._layout.script')
</body>

</html>