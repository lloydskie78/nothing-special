<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Citihardware - Admin</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="stylesheet" href="{{ 'assets/vendor/simple-line-icons/css/simple-line-icons.css' }}">
    <link rel="stylesheet" href="{{ 'assets/vendor/font-awesome/css/fontawesome-all.min.css' }}">

    <!-- link to Data Tables Plugin -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tooltipster.bundle.min.css') }}">
    <!--Tooltipster Plugin-->
    <link rel="stylesheet" href="{{ asset('assets/css/tooltipster.custom.css') }}">
    <!--Custom Tooltipster Plugin-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">

    <script src="{{ asset('admin/assets/vendor/jquery/jquery.min.js') }}"></script>


</head>

<body class="sidebar-fixed header-fixed">
    @include('admin.layouts.modal')
    <div class="page-wrapper">
        @include('admin.includes.top-nav')

        <div class="main-container">
            @include('admin.includes.side-nav')

            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>



    <script src="{{ asset('admin/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/popper.js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/carbon.js') }}"></script>
    <script src="{{ asset('admin/assets/js/demo.js') }}"></script>


    <!-- script to Data Table -->
    <script src="{{ asset('admin/assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.select.min.js') }}"></script>
    <!-- script to Sweet Alert -->
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('admin/assets/js/tinymce/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/tinymce/tinymce.min.js') }}"></script>
    @stack('scripts')

    <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/mapresizer.js') }}" type="text/javascript"></script>
    <!--Mapresizer plugin-->
    <script src="{{ asset('assets/js/tooltipster.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}" type="text/javascript"></script>



</body>

</html>