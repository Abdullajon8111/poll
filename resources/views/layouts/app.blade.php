<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

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
        <main class="container my-5">
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
