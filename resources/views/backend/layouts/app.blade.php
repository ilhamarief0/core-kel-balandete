<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title }} | Kelurahan Balandete</title>
        <meta name="description" content="The simple way to manage your citizens">
        <link href="{{ asset('assets/backend/output.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        @stack('styles')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel="stylesheet" />

        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/frontend/logo/logo.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('assets/frontend/logo/logo.png') }}">

        <meta property="og:title" content="The simple way to manage your citizens">
        <meta property="og:description" content="The simple way to manage your citizens">
        <meta property="og:image" content="https://desa-digital.netlify.app/assets/images/logos/logo-icon.png">
        <meta property="og:url" content="https://desa-digital.netlify.app">
        <meta property="og:type" content="website">
    </head>
    <body>
        <div class="flex flex-1">
            @include('backend.layouts.sidebar')
            <div id="Main-Container" class="flex flex-col flex-1">
               @include('backend.layouts.header')
               @yield('content')
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/backend/js/accordion.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('assets/backend/js/statistik-penduduk.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
            }

            @if(session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        </script>

        @stack('scripts')
    </body>
</html>
