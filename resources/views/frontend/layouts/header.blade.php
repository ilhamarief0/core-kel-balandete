<div class="bg-[#F6F7FA] relative">
    <div class="container max-w-[1130px] mx-auto relative pt-10 z-10">
        <nav class="flex flex-wrap items-center justify-between bg-white p-[20px_30px] rounded-[20px] gap-y-3">
            <div class="flex items-center gap-3">
                <div class="flex shrink-0 h-[43px] overflow-hidden">
                    <img src="{{ asset('assets/frontend/logo/logo.png') }}" class="object-contain w-full h-full" alt="logo">
                </div>
                <div class="flex flex-col">
                    <p id="CompanyName" class="font-extrabold text-xl leading-[30px]">BalandeteKu</p>
                    <p id="CompanyTagline" class="text-sm text-cp-light-grey">Dari Balandete Untuk Semua</p>
                </div>
            </div>
            <ul class="flex flex-wrap items-center gap-[30px]">
                <li class="font-semibold hover:text-cp-dark-blue transition-all duration-300 {{ request()->is('/') ? 'text-cp-dark-blue' : '' }}">
                    <a href="{{ route('landingpage.index') }}">Home</a>
                </li>
                <li class="font-semibold hover:text-cp-dark-blue transition-all duration-300 {{ request()->routeIs('products.*') ? 'text-cp-dark-blue' : '' }}">
                    <a href="{{ route('landingpage.index') }}">Products</a>
                </li>
                <li class="font-semibold hover:text-cp-dark-blue transition-all duration-300 {{ request()->routeIs('company') ? 'text-cp-dark-blue' : '' }}">
                    <a href="{{ route('landingpage.index') }}">Company</a>
                </li>
                <li class="font-semibold hover:text-cp-dark-blue transition-all duration-300 {{ request()->routeIs('news.*') ? 'text-cp-dark-blue' : '' }}">
                    <a href="{{ route('news.index') }}">Berita</a>
                </li>
                <li class="font-semibold hover:text-cp-dark-blue transition-all duration-300 {{ request()->routeIs('about') ? 'text-cp-dark-blue' : '' }}">
                    <a href="{{ route('landingpage.index') }}">About</a>
                </li>
            </ul>
            <a href="{{ route('contactus.index') }}" class="bg-cp-dark-blue p-[14px_20px] w-fit rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">Contact Us</a>
        </nav>
    </div>
</div>
