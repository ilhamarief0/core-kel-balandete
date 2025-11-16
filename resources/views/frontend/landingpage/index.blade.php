@extends('frontend.layouts.app')

@section('content')
<style>
    /* Keyframes untuk animasi highlight */
    @keyframes wipe-highlight {
        /* Mulai dan Selesai dalam keadaan tersembunyi */
        0%, 100% {
            transform: scaleX(0);
        }
        /* Muncul dan bertahan */
        20%, 80% {
            transform: scaleX(1);
        }
    }

    /* Class untuk span yang membungkus teks */
    .animated-highlight {
        position: relative; /* Diperlukan agar ::before bisa diposisikan */
        display: inline-block;
        color: #fff; /* Warna teks gelap agar kontras dengan highlight */
        padding: 2px 6px;
    }

    /* Elemen semu yang akan menjadi highlight kuning */
    .animated-highlight::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgb(0, 122, 255);
        border-radius: 6px;
        z-index: -1;

        transform-origin: left;
        animation: wipe-highlight 10s ease-in-out infinite;
    }
</style>

<div id="header-hero" class="relative w-full h-screen">
    <img src="{{ asset('assets/frontend/backgrounds/bupati.jpg') }}" class="absolute top-0 left-0 w-full h-full object-cover z-10" alt="banner">
    <div class="absolute top-0 left-0 w-full h-full bg-black opacity-50 z-20"></div>

    <div class="container max-w-[1130px] mx-auto relative z-30 h-full flex items-center">
        <div id="Hero" class="flex flex-col gap-[30px] w-full max-w-[536px]">
            <div class="flex flex-col gap-[10px]">
                <h1 class="font-extrabold text-[50px] leading-[65px] text-white">Selamat Datang Di Website <span class="animated-highlight">BalandeteKu</span></h1>
                <p class="text-gray-200 leading-[30px]">{{ $websiteDescription }}.</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="" class="bg-cp-dark-blue p-5 w-fit rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">Profil Kami</a>
            </div>
        </div>
    </div>
</div>
<div class="absolute w-full lg:w-[43%] h-full top-0 right-0 overflow-hidden z-0">
    <img src="{{ asset('assets/frontend/backgrounds/bupati.jpg') }}" class="object-cover w-full h-full" alt="banner">
</div>
</div>

{{-- Services Section --}}
<div id="Services" class="container max-w-[1130px] mx-auto flex flex-wrap items-center justify-center gap-[30px] -mt-20 relative z-40">
    <a href="#" class="card w-[356.67px] flex flex-col items-center p-[30px] rounded-[20px] bg-white border border-[#E8EAF2] hover:border-cp-dark-blue transition-all duration-300 transform hover:-translate-y-2">
        <div class="w-[70px] h-[70px] flex shrink-0 items-center justify-center rounded-full bg-cp-pale-blue mb-5">
            <img src="{{ asset('assets/frontend/icons/document-text.svg') }}" alt="icon" class="w-1/2 h-1/2 object-contain">
        </div>
        <h3 class="font-bold text-xl leading-[30px] mb-2">Layanan Surat</h3>
        <p class="text-center text-cp-light-grey leading-[24px]">Mempermudah masyarakat dalam mengurus surat-surat penting.</p>
    </a>
    <a href="#" class="card w-[356.67px] flex flex-col items-center p-[30px] rounded-[20px] bg-white border border-[#E8EAF2] hover:border-cp-dark-blue transition-all duration-300 transform hover:-translate-y-2">
        <div class="w-[70px] h-[70px] flex shrink-0 items-center justify-center rounded-full bg-cp-pale-blue mb-5">
            <img src="{{ asset('assets/frontend/icons/people.svg') }}" alt="icon" class="w-1/2 h-1/2 object-contain">
        </div>
        <h3 class="font-bold text-xl leading-[30px] mb-2">Informasi Penduduk</h3>
        <p class="text-center text-cp-light-grey leading-[24px]">Menyediakan data dan statistik terkini mengenai kependudukan.</p>
    </a>
    <a href="#" class="card w-[356.67px] flex flex-col items-center p-[30px] rounded-[20px] bg-white border border-[#E8EAF2] hover:border-cp-dark-blue transition-all duration-300 transform hover:-translate-y-2">
        <div class="w-[70px] h-[70px] flex shrink-0 items-center justify-center rounded-full bg-cp-pale-blue mb-5">
            <img src="{{ asset('assets/frontend/icons/map.svg') }}" alt="icon" class="w-1/2 h-1/2 object-contain">
        </div>
        <h3 class="font-bold text-xl leading-[30px] mb-2">Peta Wilayah</h3>
        <p class="text-center text-cp-light-grey leading-[24px]">Peta interaktif untuk memudahkan navigasi di area kelurahan.</p>
    </a>
</div>
{{-- End Services Section --}}

<div id="OurPrinciples" class="container max-w-[1130px] mx-auto flex flex-col gap-[30px] mt-20">
    <div class="flex items-center justify-between">
        <div class="flex flex-col gap-[14px]">
            <p class="badge w-fit bg-cp-pale-blue text-cp-light-blue p-[8px_16px] rounded-full uppercase font-bold text-sm">INFORMASI KELURAHAN</p>
            <h2 class="font-bold text-4xl leading-[45px]">Informasi Terbaru Dari <br> Kelurahan Balandete</h2>
        </div>
        <a href="" class="bg-cp-black p-[14px_20px] w-fit rounded-xl font-bold text-white">Explore More</a>
    </div>
    <div class="flex flex-wrap items-center justify-center gap-[30px]">
        @foreach ($news as $newsItem)
        <a href="{{ route('news.detail', Str::slug($newsItem->title)) }}" class="group card w-full sm:w-[356.67px] flex flex-col bg-white border border-[#E8EAF2] rounded-[20px] shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
            <div class="thumbnail h-[200px] w-full overflow-hidden">
                <img src="{{ asset('storage/'. $newsItem->image) }}" class="object-cover object-center w-full h-full group-hover:scale-110 transition-transform duration-500" alt="thumbnail berita">
            </div>
            <div class="flex flex-col p-[20px] sm:p-[30px] gap-4 sm:gap-5 flex-1">
                <h3 class="font-bold text-lg sm:text-xl leading-tight text-gray-900 group-hover:text-cp-dark-blue transition-colors duration-300">
                    {{ $newsItem->title }}
                </h3>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 2v4"></path>
                        <path d="M16 2v4"></path>
                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                        <path d="M3 10h18"></path>
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($newsItem->created_at)->translatedFormat('d F Y') }}</span>
                </div>
                <p class="text-sm sm:text-base leading-snug text-gray-500">
                    {{ \Illuminate\Support\Str::limit(strip_tags($newsItem->content), 80, '...') }}
                </p>
                <div class="mt-auto pt-2">
                    <span class="font-semibold text-cp-dark-blue group-hover:underline text-sm sm:text-base transition-colors duration-300">
                        Lihat Selengkapnya &rarr;
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
<div id="Stats" class="bg-cp-black w-full mt-20">
    <div class="container max-w-[1000px] mx-auto py-10">
        <div class="flex flex-wrap items-center justify-between p-[10px]">
            <div class="card w-[200px] flex flex-col items-center gap-[10px] text-center">
                <div class="w-[55px] h-[55px] flex shrink-0 overflow-hidden">
                    <img src="{{ asset('assets/frontend/icons/cup.svg') }}" class="object-contain w-full h-full" alt="icon">
                </div>
                <p class="text-cp-pale-orange font-bold text-4xl leading-[54px]">189.409</p>
                <p class="text-cp-light-grey">Award-winning Buildings</p>
            </div>
            <div class="card w-[200px] flex flex-col items-center gap-[10px] text-center">
                <div class="w-[55px] h-[55px] flex shrink-0 overflow-hidden">
                    <img src="{{ asset('assets/frontend/icons/buildings.svg') }}" class="object-contain w-full h-full" alt="icon">
                </div>
                <p class="text-cp-pale-orange font-bold text-4xl leading-[54px]">198</p>
                <p class="text-cp-light-grey">HQ Worldwide</p>
            </div>
            <div class="card w-[200px] flex flex-col items-center gap-[10px] text-center">
                <div class="w-[55px] h-[55px] flex shrink-0 overflow-hidden">
                    <img src="{{ asset('assets/frontend/icons/status-up.svg') }}" class="object-contain w-full h-full" alt="icon">
                </div>
                <p class="text-cp-pale-orange font-bold text-4xl leading-[54px]">$512bn</p>
                <p class="text-cp-light-grey">Success Investments</p>
            </div>
            <div class="card w-[200px] flex flex-col items-center gap-[10px] text-center">
                <div class="w-[55px] h-[55px] flex shrink-0 overflow-hidden">
                    <img src="{{ asset('assets/frontend/icons/star.svg') }}" class="object-contain w-full h-full" alt="icon">
                </div>
                <p class="text-cp-pale-orange font-bold text-4xl leading-[54px]">4.9/5</p>
                <p class="text-cp-light-grey">Honest Reviews</p>
            </div>
        </div>
    </div>
</div>
<div id="Products" class="container max-w-[1130px] mx-auto flex flex-col gap-20 mt-20">
    <div class="product flex flex-wrap justify-center items-center gap-[60px] even:flex-row-reverse">
        <div class="w-[470px] h-[550px] flex shrink-0 overflow-hidden">
            <img src="{{ asset('assets/frontend/thumbnails/product cover one.png') }}" class="w-full h-full object-contain" alt="thumbnail">
        </div>
        <div class="flex flex-col gap-[30px] py-[50px] h-fit max-w-[500px]">
            <p class="badge w-fit bg-cp-pale-blue text-cp-light-blue p-[8px_16px] rounded-full uppercase font-bold text-sm">WORLD TRADE CENTER</p>
            <div class="flex flex-col gap-[10px]">
                <h2 class="font-bold text-4xl leading-[45px]">Office Integrated with Biggest Data Server Center</h2>
                <p class="leading-[30px] text-cp-light-grey">Lorem ipsum angga’s framework researching amet dolor metrics and perfomance burning rate random says.</p>
            </div>
            <a href="" class="bg-cp-dark-blue p-[14px_20px] w-fit rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">Book Appointment</a>
        </div>
    </div>
    <div class="product flex flex-wrap justify-center items-center gap-[60px] even:flex-row-reverse">
        <div class="w-[470px] h-[550px] flex shrink-0 overflow-hidden">
            <img src="{{ asset('assets/frontend/thumbnails/product cover two.png') }}" class="w-full h-full object-contain" alt="thumbnail">
        </div>
        <div class="flex flex-col gap-[30px] py-[50px] h-fit max-w-[500px]">
            <p class="badge w-fit bg-cp-pale-blue text-cp-light-blue p-[8px_16px] rounded-full uppercase font-bold text-sm">FAMILY HARMONY</p>
            <div class="flex flex-col gap-[10px]">
                <h2 class="font-bold text-4xl leading-[45px]">Beautiful Theme Park Family and Kids Friendly</h2>
                <p class="leading-[30px] text-cp-light-grey">Lorem ipsum angga’s framework researching amet dolor metrics and perfomance burning rate random says.</p>
            </div>
            <a href="" class="bg-cp-dark-blue p-[14px_20px] w-fit rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">Book Appointment</a>
        </div>
    </div>
    <div class="product flex flex-wrap justify-center items-center gap-[60px] even:flex-row-reverse">
        <div class="w-[470px] h-[550px] flex shrink-0 overflow-hidden">
            <img src="{{ asset('assets/frontend/thumbnails/product cover three.png') }}" class="w-full h-full object-contain" alt="thumbnail">
        </div>
        <div class="flex flex-col gap-[30px] py-[50px] h-fit max-w-[500px]">
            <p class="badge w-fit bg-cp-pale-blue text-cp-light-blue p-[8px_16px] rounded-full uppercase font-bold text-sm">ECO-FRIENDLY SPACE</p>
            <div class="flex flex-col gap-[10px]">
                <h2 class="font-bold text-4xl leading-[45px]">Public City Center Park with Super Mall & Airport</h2>
                <p class="leading-[30px] text-cp-light-grey">Lorem ipsum angga’s framework researching amet dolor metrics and perfomance burning rate random says.</p>
            </div>
            <a href="" class="bg-cp-dark-blue p-[14px_20px] w-fit rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">Book Appointment</a>
        </div>
    </div>
</div>
<div id="Teams" class="bg-[#F6F7FA] w-full py-20 px-[10px] mt-20">
    <div class="container max-w-[1130px] mx-auto flex flex-col gap-[30px] items-center">
        <div class="flex flex-col gap-[14px] items-center">
            <p class="badge w-fit bg-cp-light-blue text-white p-[8px_16px] rounded-full uppercase font-bold text-sm">OUR POWERFUL TEAM</p>
            <h2 class="font-bold text-4xl leading-[45px] text-center">We Share Same Dreams <br> Change The World</h2>
        </div>
        <div class="teams-card-container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[30px] justify-center">
            <div class="card bg-white flex flex-col h-full justify-center items-center p-[30px] px-[29px] gap-[30px] rounded-[20px] border border-white hover:shadow-[0_10px_30px_0_#D1D4DF80] hover:border-cp-dark-blue transition-all duration-300">
                <div class="w-[100px] h-[100px] flex shrink-0 items-center justify-center rounded-full bg-[linear-gradient(150.55deg,_#007AFF_8.72%,_#312ECB_87.11%)]">
                    <div class="w-[90px] h-[90px] rounded-full overflow-hidden">
                        <img src="{{ asset('assets/frontend/photos/photo1.png') }}" class="object-cover w-full h-full object-center" alt="photo">
                    </div>
                </div>
                <div class="flex flex-col gap-1 text-center">
                    <p class="font-bold text-xl leading-[30px]">Angga Setiawan</p>
                    <p class="text-cp-light-grey">Chief Executive Officer</p>
                </div>
                <div class="flex items-center justify-center gap-[10px]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets/frontend/icons/global.svg') }}" alt="icon">
                    </div>
                    <p class="text-cp-dark-blue font-semibold">Shanghai, China</p>
                </div>
            </div>
            <div class="card bg-white flex flex-col h-full justify-center items-center p-[30px] px-[29px] gap-[30px] rounded-[20px] border border-white hover:shadow-[0_10px_30px_0_#D1D4DF80] hover:border-cp-dark-blue transition-all duration-300">
                <div class="w-[100px] h-[100px] flex shrink-0 items-center justify-center rounded-full bg-[linear-gradient(150.55deg,_#007AFF_8.72%,_#312ECB_87.11%)]">
                    <div class="w-[90px] h-[90px] rounded-full overflow-hidden">
                        <img src="{{ asset('assets/frontend/photos/photo2.png') }}" class="object-cover w-full h-full object-center" alt="photo">
                    </div>
                </div>
                <div class="flex flex-col gap-1 text-center">
                    <p class="font-bold text-xl leading-[30px]">Shayna Liza</p>
                    <p class="text-cp-light-grey">Product Manager</p>
                </div>
                <div class="flex items-center justify-center gap-[10px]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets/frontend/icons/global.svg') }}" alt="icon">
                    </div>
                    <p class="text-cp-dark-blue font-semibold">Bali, Indonesia</p>
                </div>
            </div>
            <div class="card bg-white flex flex-col h-full justify-center items-center p-[30px] px-[29px] gap-[30px] rounded-[20px] border border-white hover:shadow-[0_10px_30px_0_#D1D4DF80] hover:border-cp-dark-blue transition-all duration-300">
                <div class="w-[100px] h-[100px] flex shrink-0 items-center justify-center rounded-full bg-[linear-gradient(150.55deg,_#007AFF_8.72%,_#312ECB_87.11%)]">
                    <div class="w-[90px] h-[90px] rounded-full overflow-hidden">
                        <img src="{{ asset('assets/frontend/photos/photo3.png') }}" class="object-cover w-full h-full object-center" alt="photo">
                    </div>
                </div>
                <div class="flex flex-col gap-1 text-center">
                    <p class="font-bold text-xl leading-[30px]">Bruno Oleo</p>
                    <p class="text-cp-light-grey">Customer Relations</p>
                </div>
                <div class="flex items-center justify-center gap-[10px]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets/frontend/icons/global.svg') }}" alt="icon">
                    </div>
                    <p class="text-cp-dark-blue font-semibold">Orchard, Singapore</p>
                </div>
            </div>
            <div class="card bg-white flex flex-col h-full justify-center items-center p-[30px] px-[29px] gap-[30px] rounded-[20px] border border-white hover:shadow-[0_10px_30px_0_#D1D4DF80] hover:border-cp-dark-blue transition-all duration-300">
                <div class="w-[100px] h-[100px] flex shrink-0 items-center justify-center rounded-full bg-[linear-gradient(150.55deg,_#007AFF_8.72%,_#312ECB_87.11%)]">
                    <div class="w-[90px] h-[90px] rounded-full overflow-hidden">
                        <img src="{{ asset('assets/frontend/photos/photo4.png') }}" class="object-cover w-full h-full object-center" alt="photo">
                    </div>
                </div>
                <div class="flex flex-col gap-1 text-center">
                    <p class="font-bold text-xl leading-[30px]">Sami Kimi</p>
                    <p class="text-cp-light-grey">Senior 3D Designer</p>
                </div>
                <div class="flex items-center justify-center gap-[10px]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets/frontend/icons/global.svg') }}" alt="icon">
                    </div>
                    <p class="text-cp-dark-blue font-semibold">Ho Chi Min, Vietnam</p>
                </div>
            </div>
            <div class="card bg-white flex flex-col h-full justify-center items-center p-[30px] px-[29px] gap-[30px] rounded-[20px] border border-white hover:shadow-[0_10px_30px_0_#D1D4DF80] hover:border-cp-dark-blue transition-all duration-300">
                <div class="w-[100px] h-[100px] flex shrink-0 items-center justify-center rounded-full bg-[linear-gradient(150.55deg,_#007AFF_8.72%,_#312ECB_87.11%)]">
                    <div class="w-[90px] h-[90px] rounded-full overflow-hidden">
                        <img src="{{ asset('assets/frontend/photos/photo5.png') }}" class="object-cover w-full h-full object-center" alt="photo">
                    </div>
                </div>
                <div class="flex flex-col gap-1 text-center">
                    <p class="font-bold text-xl leading-[30px]">Wibowo Putra</p>
                    <p class="text-cp-light-grey">Senior 3D Designer</p>
                </div>
                <div class="flex items-center justify-center gap-[10px]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets/frontend/icons/global.svg') }}" alt="icon">
                    </div>
                    <p class="text-cp-dark-blue font-semibold">Ho Chi Min, Vietnam</p>
                </div>
            </div>
            <div class="card bg-white flex flex-col h-full justify-center items-center p-[30px] px-[29px] gap-[30px] rounded-[20px] border border-white hover:shadow-[0_10px_30px_0_#D1D4DF80] hover:border-cp-dark-blue transition-all duration-300">
                <div class="w-[100px] h-[100px] flex shrink-0 items-center justify-center rounded-full bg-[linear-gradient(150.55deg,_#007AFF_8.72%,_#312ECB_87.11%)]">
                    <div class="w-[90px] h-[90px] rounded-full overflow-hidden">
                        <img src="{{ asset('assets/frontend/photos/photo6.png') }}" class="object-cover w-full h-full object-center" alt="photo">
                    </div>
                </div>
                <div class="flex flex-col gap-1 text-center">
                    <p class="font-bold text-xl leading-[30px]">Putri Emily</p>
                    <p class="text-cp-light-grey">Chief Executive Officer</p>
                </div>
                <div class="flex items-center justify-center gap-[10px]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets/frontend/icons/global.svg') }}" alt="icon">
                    </div>
                    <p class="text-cp-dark-blue font-semibold">Shanghai, China</p>
                </div>
            </div>
            <div class="card bg-white flex flex-col h-full justify-center items-center p-[30px] px-[29px] gap-[30px] rounded-[20px] border border-white hover:shadow-[0_10px_30px_0_#D1D4DF80] hover:border-cp-dark-blue transition-all duration-300">
                <div class="w-[100px] h-[100px] flex shrink-0 items-center justify-center rounded-full bg-[linear-gradient(150.55deg,_#007AFF_8.72%,_#312ECB_87.11%)]">
                    <div class="w-[90px] h-[90px] rounded-full overflow-hidden">
                        <img src="{{ asset('assets/frontend/photos/photo7.png') }}" class="object-cover w-full h-full object-center" alt="photo">
                    </div>
                </div>
                <div class="flex flex-col gap-1 text-center">
                    <p class="font-bold text-xl leading-[30px]">Yuyan Chin</p>
                    <p class="text-cp-light-grey">Product Manager</p>
                </div>
                <div class="flex items-center justify-center gap-[10px]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets/frontend/icons/global.svg') }}" alt="icon">
                    </div>
                    <p class="text-cp-dark-blue font-semibold">Bali, Indonesia</p>
                </div>
            </div>
            <a href="team.html" class="view-all-card">
                <div class="card bg-white flex flex-col h-full justify-center items-center p-[30px] gap-[30px] rounded-[20px] border border-white hover:shadow-[0_10px_30px_0_#D1D4DF80] hover:border-cp-dark-blue transition-all duration-300">
                    <div class="w-[60px] h-[60px] flex shrink-0">
                        <img src="{{ asset('assets/frontend/icons/profile-2user.svg') }}" alt="icon">
                    </div>
                    <div class="flex flex-col gap-1 text-center">
                        <p class="font-bold text-xl leading-[30px]">View All</p>
                        <p class="text-cp-light-grey">Our Great People</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div id="Testimonials" class="w-full flex flex-col gap-[50px] items-center mt-20">
    <div class="flex flex-col gap-[14px] items-center">
        <p class="badge w-fit bg-cp-pale-blue text-cp-light-blue p-[8px_16px] rounded-full uppercase font-bold text-sm">SUCCESS CLIENTS</p>
        <h2 class="font-bold text-4xl leading-[45px] text-center">Our Satisfied Clients<br>From Worldwide Company</h2>
    </div>
    <div class="main-carousel w-full">
        <div class="carousel-card container max-w-[1130px] w-full flex flex-wrap justify-between items-center lg:mx-[calc((100vw-1130px)/2)]">
            <div class="testimonial-container flex flex-col gap-[112px] w-[565px]">
                <div class="flex flex-col gap-[30px]">
                    <div class="h-9 overflow-hidden">
                        <img src="{{ asset('assets/frontend/logo/logo-54.svg') }}" class="object-contain" alt="icon">
                    </div>
                    <div class="relative pt-[27px] pl-[30px]">
                        <div class="absolute top-0 left-0">
                            <img src="{{ asset('assets/frontend/icons/quote.svg') }}" alt="icon">
                        </div>
                        <p class="font-semibold text-2xl leading-[46px] relative z-10">Shayna is a leading construction company in Melbourne, building new homes and commercial projects that are durable, functional and beautiful.</p>
                    </div>
                    <div class="flex items-center justify-between pl-[30px]">
                        <div class="flex items-center gap-6">
                            <div class="w-[60px] h-[60px] flex shrink-0 rounded-full overflow-hidden">
                                <img src="{{ asset('assets/frontend/photos/photo3.png') }}" class="w-full h-full object-cover" alt="photo">
                            </div>
                            <div class="flex flex-col justify-center gap-1">
                                <p class="font-bold">Sirania</p>
                                <p class="text-sm text-cp-light-grey">CRO Kamikapan</p>
                            </div>
                        </div>
                        <div class="flex flex-nowrap">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-indicator flex items-center justify-center gap-2 h-4 shrink-0">
                </div>
            </div>
            <div class="testimonial-thumbnail w-[470px] h-[550px] rounded-[20px] overflow-hidden bg-[#D9D9D9]">
                <img src="{{ asset('assets/frontend/backgrounds/banner.jpg') }}" class="w-full h-full object-cover object-center" alt="thumbnail">
            </div>
        </div>
        <div class="carousel-card container max-w-[1130px] w-full flex flex-wrap justify-between items-center lg:mx-[calc((100vw-1130px)/2)]">
            <div class="testimonial-container flex flex-col gap-[112px] w-[565px]">
                <div class="flex flex-col gap-[30px]">
                    <div class="h-9 overflow-hidden">
                        <img src="{{ asset('assets/frontend/logo/logo-51.svg') }}" class="object-contain" alt="icon">
                    </div>
                    <div class="relative pt-[27px] pl-[30px]">
                        <div class="absolute top-0 left-0">
                            <img src="{{ asset('assets/frontend/icons/quote.svg') }}" alt="icon">
                        </div>
                        <p class="font-semibold text-2xl leading-[46px] relative z-10">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil distinctio quasi blanditiis dolorum iste velit. Quo alias non ab debitis!</p>
                    </div>
                    <div class="flex items-center justify-between pl-[30px]">
                        <div class="flex items-center gap-6">
                            <div class="w-[60px] h-[60px] flex shrink-0 rounded-full overflow-hidden">
                                <img src="{{ asset('assets/frontend/photos/photo2.png') }}" class="w-full h-full object-cover" alt="photo">
                            </div>
                            <div class="flex flex-col justify-center gap-1">
                                <p class="font-bold">Bruno Oleo</p>
                                <p class="text-sm text-cp-light-grey">Customer Relations</p>
                            </div>
                        </div>
                        <div class="flex flex-nowrap">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-indicator flex items-center justify-center gap-2 h-4 shrink-0">
                </div>
            </div>
            <div class="testimonial-thumbnail w-[470px] h-[550px] rounded-[20px] overflow-hidden bg-[#D9D9D9]">
                <img src="{{ asset('assets/frontend/thumbnails/cover1.jpg') }}" class="w-full h-full object-cover object-center" alt="thumbnail">
            </div>
        </div>
        <div class="carousel-card container max-w-[1130px] w-full flex flex-wrap justify-between items-center lg:mx-[calc((100vw-1130px)/2)]">
            <div class="testimonial-container flex flex-col gap-[112px] w-[565px]">
                <div class="flex flex-col gap-[30px]">
                    <div class="h-9 overflow-hidden">
                        <img src="{{ asset('assets/frontend/logo/logo-54.svg') }}" class="object-contain" alt="icon">
                    </div>
                    <div class="relative pt-[27px] pl-[30px]">
                        <div class="absolute top-0 left-0">
                            <img src="{{ asset('assets/frontend/icons/quote.svg') }}" alt="icon">
                        </div>
                        <p class="font-semibold text-2xl leading-[46px] relative z-10">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Distinctio officia, reprehenderit magni obcaecati praesentium quasi iusto rerum.</p>
                    </div>
                    <div class="flex items-center justify-between pl-[30px]">
                        <div class="flex items-center gap-6">
                            <div class="w-[60px] h-[60px] flex shrink-0 rounded-full overflow-hidden">
                                <img src="{{ asset('assets/frontend/photos/photo4.png') }}" class="w-full h-full object-cover" alt="photo">
                            </div>
                            <div class="flex flex-col justify-center gap-1">
                                <p class="font-bold">Sami Kimi</p>
                                <p class="text-sm text-cp-light-grey">Senior 3D Designer</p>
                            </div>
                        </div>
                        <div class="flex flex-nowrap">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-indicator flex items-center justify-center gap-2 h-4 shrink-0">
                </div>
            </div>
            <div class="testimonial-thumbnail w-[470px] h-[550px] rounded-[20px] overflow-hidden bg-[#D9D9D9]">
                <img src="{{ asset('assets/frontend/thumbnails/cover2.jpg') }}" class="w-full h-full object-cover object-center" alt="thumbnail">
            </div>
        </div>
        <div class="carousel-card container max-w-[1130px] w-full flex flex-wrap justify-between items-center lg:mx-[calc((100vw-1130px)/2)]">
            <div class="testimonial-container flex flex-col gap-[112px] w-[565px]">
                <div class="flex flex-col gap-[30px]">
                    <div class="h-9 overflow-hidden">
                        <img src="{{ asset('assets/frontend/logo/logo-44.svg') }}" class="object-contain" alt="icon">
                    </div>
                    <div class="relative pt-[27px] pl-[30px]">
                        <div class="absolute top-0 left-0">
                            <img src="{{ asset('assets/frontend/icons/quote.svg') }}" alt="icon">
                        </div>
                        <p class="font-semibold text-2xl leading-[46px] relative z-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, rem!</p>
                    </div>
                    <div class="flex items-center justify-between pl-[30px]">
                        <div class="flex items-center gap-6">
                            <div class="w-[60px] h-[60px] flex shrink-0 rounded-full overflow-hidden">
                                <img src="{{ asset('assets/frontend/photos/photo7.png') }}" class="w-full h-full object-cover" alt="photo">
                            </div>
                            <div class="flex flex-col justify-center gap-1">
                                <p class="font-bold">Yuyan Chin</p>
                                <p class="text-sm text-cp-light-grey">Product Manager</p>
                            </div>
                        </div>
                        <div class="flex flex-nowrap">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/frontend/icons/Star-rating.svg') }}" alt="star">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-indicator flex items-center justify-center gap-2 h-4 shrink-0">
                </div>
            </div>
            <div class="testimonial-thumbnail w-[470px] h-[550px] rounded-[20px] overflow-hidden bg-[#D9D9D9]">
                <img src="{{ asset('assets/frontend/thumbnails/cover3.jpg') }}" class="w-full h-full object-cover object-center" alt="thumbnail">
            </div>
        </div>
    </div>
</div>
<div id="Awards" class="container max-w-[1130px] mx-auto flex flex-col gap-[30px] mt-20">
    <div class="flex items-center justify-between">
        <div class="flex flex-col gap-[14px]">
            <p class="badge w-fit bg-cp-pale-blue text-cp-light-blue p-[8px_16px] rounded-full uppercase font-bold text-sm">OUR AWARDS</p>
            <h2 class="font-bold text-4xl leading-[45px]">We’ve Dedicated Our<br>Best Team Efforts</h2>
        </div>
        <a href="" class="bg-cp-black p-[14px_20px] w-fit rounded-xl font-bold text-white">Explore More</a>
    </div>
    <div class="awards-card-container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[30px] justify-center">
        <div class="card bg-white flex flex-col h-full p-[30px] gap-[30px] rounded-[20px] border border-[#E8EAF2] hover:border-cp-dark-blue transition-all duration-300">
            <div class="w-[55px] h-[55px] flex shrink-0">
                <img src="{{ asset('assets/frontend/icons/cup-blue.svg') }}" alt="icon">
            </div>
            <hr class="border-[#E8EAF2]">
            <p class="font-bold text-xl leading-[30px]">Solid Fundamental Crafter Async</p>
            <hr class="border-[#E8EAF2]">
            <p class="text-cp-light-grey">Bali, 2020</p>
        </div>
        <div class="card bg-white flex flex-col h-full p-[30px] gap-[30px] rounded-[20px] border border-[#E8EAF2] hover:border-cp-dark-blue transition-all duration-300">
            <div class="w-[55px] h-[55px] flex shrink-0">
                <img src="{{ asset('assets/frontend/icons/cup-blue.svg') }}" alt="icon">
            </div>
            <hr class="border-[#E8EAF2]">
            <p class="font-bold text-xl leading-[30px]">Most Crowded Yet Harmony Place</p>
            <hr class="border-[#E8EAF2]">
            <p class="text-cp-light-grey">Shanghai, 2021</p>
        </div>
        <div class="card bg-white flex flex-col h-full p-[30px] gap-[30px] rounded-[20px] border border-[#E8EAF2] hover:border-cp-dark-blue transition-all duration-300">
            <div class="w-[55px] h-[55px] flex shrink-0">
                <img src="{{ asset('assets/frontend/icons/cup-blue.svg') }}" alt="icon">
            </div>
            <hr class="border-[#E8EAF2]">
            <p class="font-bold text-xl leading-[30px]">Small Things Made Much Big Impacts</p>
            <hr class="border-[#E8EAF2]">
            <p class="text-cp-light-grey">Zurich, 2022</p>
        </div>
        <div class="card bg-white flex flex-col h-full p-[30px] gap-[30px] rounded-[20px] border border-[#E8EAF2] hover:border-cp-dark-blue transition-all duration-300">
            <div class="w-[55px] h-[55px] flex shrink-0">
                <img src="{{ asset('assets/frontend/icons/cup-blue.svg') }}" alt="icon">
            </div>
            <hr class="border-[#E8EAF2]">
            <p class="font-bold text-xl leading-[30px]">Teamwork and Solidarity</p>
            <hr class="border-[#E8EAF2]">
            <p class="text-cp-light-grey">Bandung, 2023</p>
        </div>
    </div>
</div>
<div id="FAQ" class="bg-[#F6F7FA] w-full py-20 px-[10px] mt-20 -mb-20">
    <div class="container max-w-[1000px] mx-auto">
        <div class="flex flex-col lg:flex-row gap-[50px] sm:gap-[70px] items-center">
            <div class="flex flex-col gap-[30px]">
                <div class="flex flex-col gap-[10px]">
                    <h2 class="font-bold text-4xl leading-[45px]">Frequently Asked Questions</h2>
                </div>
                <a href="contact.html" class="p-5 bg-cp-black rounded-xl text-white w-fit font-bold">Contact Us</a>
            </div>
            <div class="flex flex-col gap-[30px] sm:w-[603px] shrink-0">
                <div class="flex flex-col p-5 rounded-2xl bg-white w-full">
                    <button class="accordion-button flex justify-between gap-1 items-center" data-accordion="accordion-faq-1">
                        <span class="font-bold text-lg leading-[27px] text-left">Can installments be beneficial for both?</span>
                        <div class="arrow w-9 h-9 flex shrink-0">
                            <img src="{{ asset('assets/frontend/icons/arrow-circle-down.svg') }}" class="transition-all duration-300" alt="icon">
                        </div>
                    </button>
                    <div id="accordion-faq-1" class="accordion-content hide">
                        <p class="leading-[30px] text-cp-light-grey pt-[14px]">We want to protect our and clients assets to the max level so that we chose the best one from Jakarta, Indonesia will also protect post building finished completed ahead one.</p>
                    </div>
                </div>
                <div class="flex flex-col p-5 rounded-2xl bg-white w-full">
                    <button class="accordion-button flex justify-between gap-1 items-center" data-accordion="accordion-faq-2">
                        <span class="font-bold text-lg leading-[27px] text-left">What kind of framework you popular with?</span>
                        <div class="arrow w-9 h-9 flex shrink-0">
                            <img src="{{ asset('assets/frontend/icons/arrow-circle-down.svg') }}" class="transition-all duration-300" alt="icon">
                        </div>
                    </button>
                    <div id="accordion-faq-2" class="accordion-content hide">
                        <p class="leading-[30px] text-cp-light-grey pt-[14px]">We want to protect our and clients assets to the max level so that we chose the best one from Jakarta, Indonesia will also protect post building finished completed ahead one.</p>
                    </div>
                </div>
                <div class="flex flex-col p-5 rounded-2xl bg-white w-full">
                    <button class="accordion-button flex justify-between gap-1 items-center" data-accordion="accordion-faq-3">
                        <span class="font-bold text-lg leading-[27px] text-left">What insurance provider do you use?</span>
                        <div class="arrow w-9 h-9 flex shrink-0">
                            <img src="{{ asset('assets/frontend/icons/arrow-circle-down.svg') }}" class="transition-all duration-300" alt="icon">
                        </div>
                    </button>
                    <div id="accordion-faq-3" class="accordion-content hide">
                        <p class="leading-[30px] text-cp-light-grey pt-[14px]">We want to protect our and clients assets to the max level so that we chose the best one from Jakarta, Indonesia will also protect post building finished completed ahead one.</p>
                    </div>
                </div>
                <div class="flex flex-col p-5 rounded-2xl bg-white w-full">
                    <button class="accordion-button flex justify-between gap-1 items-center" data-accordion="accordion-faq-4">
                        <span class="font-bold text-lg leading-[27px] text-left">What if we have other questions?</span>
                        <div class="arrow w-9 h-9 flex shrink-0">
                            <img src="{{ asset('assets/frontend/icons/arrow-circle-down.svg') }}" class="transition-all duration-300" alt="icon">
                        </div>
                    </button>
                    <div id="accordion-faq-4" class="accordion-content hide">
                        <p class="leading-[30px] text-cp-light-grey pt-[14px]">We want to protect our and clients assets to the max level so that we chose the best one from Jakarta, Indonesia will also protect post building finished completed ahead one.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
