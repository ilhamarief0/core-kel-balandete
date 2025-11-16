<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title }} | BalandeteKu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets/frontend/output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity-fade@2/flickity-fade.css">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/frontend/logo/logo.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        body {
            font-family: 'Poppins', sans-serif;
        }
        .text-cp-black { color: #131417; }
        .text-cp-light-grey { color: #878C9C; }
        .text-cp-dark-blue { color: #312ECB; }
    </style>
</head>
<body class="font-poppins text-cp-black">
    @if (Route::is('landingpage.index'))
        @include('frontend.layouts.headerlanding')
    @else
        @include('frontend.layouts.header')
    @endif
    <main>

        @yield('content')

    </main>

    @include('frontend.layouts.footer')

    <div id="video-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full lg:w-1/2 max-h-full">
            <div class="relative bg-white rounded-[20px] overflow-hidden shadow">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-cp-black">
                        Company Profile Video
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="video-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="">
                    <iframe id="videoFrame" class="aspect-[16/9]" width="100%" src="" title="Demo Project Laravel Portfolio" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://unpkg.com/flickity-fade@1/flickity-fade.js"></script>
    <script src="{{ asset('assets/frontend/js/carousel.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/accordion.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{ asset('assets/frontend/js/modal-video.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}"
            });
        @endif
    </script>
</body>
</html>
