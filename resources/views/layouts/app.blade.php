<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased bg-light">
@include('layouts.navigation')

{{--        <!-- Page Heading -->--}}
{{--        <header class="d-flex py-3 bg-white shadow-sm border-bottom">--}}
{{--            <div class="container">--}}
{{--                {{ $header }}--}}
{{--            </div>--}}
{{--        </header>--}}

<!-- Page Content -->
<main class="container p-3">
    <div class="row py-3">
        <div class="col-lg-6">
            <div class="d-flex">
                <img src="{{ asset('img/logo.png') }}" alt="gerb" height="80">
{{--                <img class="ml-3" src="{{ asset('img/flag.png') }}" alt="flag" height="80">--}}
                <h6 class="ml-3 my-auto">
                    O‘ZBEKISTON RESPUBLIKASI <br>
                    OLIY TA’LIM, FAN VA INNOVATSIYALAR <br>
                    VAZIRLIGINING SO‘ROVNOMA TIZIMI
                </h6>
            </div>

        </div>

        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-6 d-flex justify-content-end">
                    <div class="d-flex justify-content-end align-items-end mb-3">
                        <a href="https://t.me/eduuz" class="btn text-white bg-twitter social rounded-circle mr-2">
                            <i class="fa fa-telegram"></i>
                        </a>

                        <a href="https://www.facebook.com/eduuzofficial/" class="btn text-white bg-facebook social rounded-circle mr-2" style="width: 40.41px">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="https://www.instagram.com/edu.uz/" class="btn text-white bg-pink social rounded-circle mr-2">
                            <i class="fa fa-instagram"></i>
                        </a>

                        <a href="https://www.youtube.com/c/eduuz" class="btn text-white bg-youtube social rounded-circle mr-2">
                            <i class="fa fa-youtube-play"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 text-right">

                    <h4 class="mb-0">{{ __('Vazirlik telefoni') }}</h4>
                    <a class="h3 font-weight-bold" href="tel:+998712306464">
                        +998 71-230-64-64
                    </a>
                </div>

            </div>

        </div>
    </div>

    {{ $slot }}
</main>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('packages/select2/dist/js/select2.full.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script>
    $('.select2').select2({
        theme: "bootstrap",
        allowClear: true,
        placeholder: "{{ __('Select an attribute') }}"
    })

    window.swal = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-dark mr-3',
            cancelButton: 'btn btn-info'
        },
        buttonsStyling: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        closeOnClickOutside: false
    })

</script>

{{ $js ?? '' }}
</body>
</html>
