<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/datatable/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap-5-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/highcharts/css/highcharts.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- JQuery --}}
    <script src="{{ asset('plugins/jquery/jquery-3.7.1.min.js') }}"></script>

    <!-- loader-->
    <link href="{{ asset('css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/pace.min.js') }}"></script>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('scss/style.scss') }}" rel="stylesheet">
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet">

    {{-- Image Uploadify --}}
    <link rel="stylesheet" href="{{ asset('plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}">

    <title>PicArt | Picture & Art</title>
</head>

<body>
    <div class="wrapper">

        {{-- Header --}}
        @include('partials.header')
        @include('partials.modal-upload')

        {{-- Content --}}
        <div class="page-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
            <div class="page-load-status">
                <div class="loader-ellips infinite-scroll-request">
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                </div>
                <p class="infinite-scroll-error">No more pages to load</p>
            </div>
        </div>

        {{-- Footer --}}
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2024. All right reserved. Roshit.</p>
        </footer>
    </div>

    {{-- Masonry, InfScroll, ImagLoad --}}
    <script src="{{ asset('js/masonry.pkgd.js') }}"></script>
    <script src="{{ asset('js/infinite-scroll.pkgd.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ asset('js/lazyload.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/clipboard.js/clipboard.min.js') }}"></script>
    <script src="{{ asset('plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>


    {{-- Highcharts --}}
    <script src="{{ asset('plugins/highcharts/js/highcharts.js') }}"></script>
    <script src="{{ asset('plugins/highcharts/js/highcharts-more.js') }}"></script>
    <script src="{{ asset('plugins/highcharts/js/variable-pie.js') }}"></script>
    <script src="{{ asset('plugins/highcharts/js/solid-gauge.js') }}"></script>
    <script src="{{ asset('plugins/highcharts/js/highcharts-3d.js') }}"></script>
    <script src="{{ asset('plugins/highcharts/js/highcharts-3d.js') }}"></script>
    <script src="{{ asset('plugins/highcharts/js/cylinder.js') }}"></script>
    <script src="{{ asset('plugins/highcharts/js/funnel3d.js') }}"></script>
    <script src="{{ asset('plugins/highcharts/js/exporting.js') }}"></script>
    <script src="{{ asset('plugins/highcharts/js/export-data.js') }}"></script>
    <script src="{{ asset('plugins/highcharts/js/accessibility.js') }}"></script>

    <!--app JS-->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#table").DataTable();
        });

        // Tooltip
        const tooltipTriggerList = $('[data-bs-hover="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>
</html>
