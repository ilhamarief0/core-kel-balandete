<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title }}</title>
        <meta name="description" content="The simple way to manage your citizens" />
        <link href="/assets/backend/output.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel="stylesheet" />

        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/backend/images/logos/logo-icon.png') }}" />
        <link rel="apple-touch-icon" href="{{ asset('assets/backend/bcakend/images/logos/logo-icon.png') }}" />

        <meta property="og:title" content="The simple way to manage your citizens" />
        <meta property="og:description" content="The simple way to manage your citizens">
        <meta property="og:image" content="https://desa-digital.netlify.app/assets/images/logos/logo-icon.png" />
        <meta property="og:url" content="https://desa-digital.netlify.app" />
        <meta property="og:type" content="website" />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <main class="flex min-h-screen items-center justify-center bg-gray-100">
            <form action="{{ route('auth.login.LoginAction') }}" method="POST">
                @csrf
                <div class="flex flex-col h-fit w-[486px] shrink-0 rounded-3xl p-[32px] gap-[32px] bg-white shadow-lg">
                    <header class="flex flex-col gap-[32px] items-center">

                        @if(session()->has('success'))
                        <div class="w-full p-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded-lg" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif

                        <img src="{{ asset('storage/'. $websiteIcon) }}" alt="icon" class="shrink-0 h-[58px] w-[297px]" />
                        <div class="flex flex-col gap-2">
                            <h1 class="font-semibold text-[24px] leading-[30px] text-center">Halo🙌🏻 , Selamat Datang!</h1>
                            <p class="font-medium leading-5 text-desa-secondary text-center">Silahkan masuk untuk melanjutkan</p>
                        </div>
                    </header>
                    <section id="Inputs" class="flex flex-col gap-[32px]">
                        <div id="Email-Address" class="flex flex-col gap-4">
                            <h2 class="font-medium leading-5 text-desa-secondary">Email Address</h2>
                            <div class="relative">
                                <input placeholder="Masukan Email Kamu" type="email" name="email" value="{{ old('email') }}" required class="peer w-full h-[56px] rounded-2xl pl-[48px] pr-4 border-[1.5px] border-desa-background font-medium leading-5 focus:ring-[1.5px] focus:ring-desa-dark-green focus:outline-none placeholder:leading-5 placeholder:text-desa-secondary placeholder:font-medium transition-all duration-300" />
                                <img src="{{ asset('assets/backend/images/icons/user-secondary-green.svg') }}" alt="icon" class="absolute shrink-0 size-6 top-1/2 left-4 -translate-y-1/2 opacity-0 peer-placeholder-shown:opacity-100 transition-all duration-300" />
                                <img src="{{ asset('assets/backend/images/icons/user-black.svg') }}" alt="icon" class="absolute shrink-0 size-6 top-1/2 left-4 -translate-y-1/2 opacity-100 peer-placeholder-shown:opacity-0 transition-all duration-300" />
                            </div>
                        </div>
                        <div id="Password" class="flex flex-col gap-4">
                            <h2 class="font-medium leading-5 text-desa-secondary">Password</h2>
                            <div class="relative">
                                <input placeholder="Ketik Password Kamu" type="password" name="password" required class="peer w-full h-[56px] rounded-2xl pl-[48px] pr-4 border-[1.5px] border-desa-background font-medium leading-5 focus:ring-[1.5px] focus:ring-desa-dark-green focus:outline-none placeholder:leading-5 placeholder:text-desa-secondary placeholder:font-medium transition-all duration-300 tracking-[0.25rem] placeholder-shown:tracking-normal" />
                                <img src="{{ asset('assets/backend/images/icons/key-secondary-green.svg') }}" alt="icon" class="absolute shrink-0 size-6 top-1/2 left-4 -translate-y-1/2 opacity-0 peer-placeholder-shown:opacity-100 transition-all duration-300" />
                                <img src="{{ asset('assets/backend/images/icons/key-black.svg') }}" alt="icon" class="absolute shrink-0 size-6 top-1/2 left-4 -translate-y-1/2 opacity-100 peer-placeholder-shown:opacity-0 transition-all duration-300" />
                            </div>
                        </div>
                    </section>
                    <button type="submit" class="py-[18px] flex justify-center items-center bg-desa-dark-green rounded-2xl font-medium leading-5 text-white">Masuk</button>
                </div>
            </form>
        </main>
        <script>
            @if(session()->has('loginError'))
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: '{{ session('loginError') }}',
                });
            @endif
        </script>
    </body>
</html>
