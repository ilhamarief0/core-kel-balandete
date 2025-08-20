<div class="td-search-popup" id="td-search-popup">
    <form action="{{ url('/search') }}" method="GET" class="search-form"> {{-- Action ke URL search --}}
        <div class="form-group">
            <input type="text" name="q" class="form-control" placeholder="Search.....">
        </div>
        <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
    </form>
</div>
<div class="body-overlay" id="body-overlay"></div>

{{-- Tambahkan kelas 'sticky-header' dan 'initial-transparent' --}}
<nav class="navbar navbar-area navbar-area-2 navbar-expand-lg sticky-header @if(Request::is('/')) initial-transparent @else bg-white @endif">
    <div class="container nav-container">
        <div class="responsive-mobile-menu">
            <button class="menu toggle-btn d-block d-lg-none" data-target="#itech_main_menu"
            aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-left"></span>
                <span class="icon-right"></span>
            </button>
        </div>
        <div class="logo-container d-flex align-items-center">
            <a href="/" class="logo-link animated-logo">
                <img src="{{ asset('storage/'. $websiteIcon) }}" alt="{{ $websiteName }} Icon" class="website-icon" style="width: 35px; height: 40px; margin-right: 10px;">
                <span class="website-name">{{ $websiteName }}</span>
            </a>
        </div>
        <div class="nav-right-part nav-right-part-mobile">
            <a class="search-bar-btn" href="#">
                <i class="fa fa-search"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="itech_main_menu">
            <ul class="navbar-nav menu-open text-lg-center ps-lg-5">
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('about.index') }}">About</a></li>
                <li><a href="{{ route('team.index') }}">Team</a></li>
                <li><a href="{{ route('news.index') }}">News</a></li>
            </ul>
        </div>
        <div class="nav-right-part nav-right-part-desktop align-self-center">
            <a class="btn btn-base ml-3 d-none d-lg-block" href="{{ route('contactus.index') }}">Contact Us <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
</nav>
