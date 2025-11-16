{{-- Header is now absolute to float over the hero section --}}
<header class="absolute top-0 left-0 w-full z-50">
    <div class="container max-w-[1130px] mx-auto relative pt-10">
        {{-- Nav background is now semi-transparent with a blur effect --}}
        <nav class="flex flex-wrap items-center justify-between bg-white bg-opacity-10 backdrop-blur-md p-[20px_30px] rounded-[20px] gap-y-3">
            <div class="flex items-center gap-3">
                <div class="flex shrink-0 h-[43px] overflow-hidden">
                    <img src="{{ asset('assets/frontend/logo/logo.png') }}" class="object-contain w-full h-full" alt="logo">
                </div>
                <div class="flex flex-col">
                    {{-- Text color changed to white for visibility --}}
                    <p id="CompanyName" class="font-extrabold text-xl leading-[30px] text-white">BalandeteKu</p>
                    <p id="CompanyTagline" class="text-sm text-gray-300">Dari Balandete Untuk Semua</p>
                </div>
            </div>
            <ul class="flex flex-wrap items-center gap-[30px]">
                {{-- Text for links is now white --}}
                <li class="font-semibold text-white hover:text-cp-dark-blue transition-all duration-300">
                    <a href="/">Home</a>
                </li>
                <li class="font-semibold text-white hover:text-cp-dark-blue transition-all duration-300">
                    <a href="#">Products</a>
                </li>
                <li class="font-semibold text-white hover:text-cp-dark-blue transition-all duration-300">
                    <a href="#">Company</a>
                </li>
                <li class="font-semibold text-white hover:text-cp-dark-blue transition-all duration-300">
                    <a href="#">Berita</a>
                </li>
                <li class="font-semibold text-white hover:text-cp-dark-blue transition-all duration-300">
                    <a href="#">About</a>
                </li>
            </ul>
            <a href="{{ route('contactus.index') }}" class="bg-cp-dark-blue p-[14px_20px] w-fit rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">Contact Us</a>
        </nav>
    </div>
</header>
