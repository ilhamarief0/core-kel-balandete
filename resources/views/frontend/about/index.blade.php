@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumb-area bg-cover" style="background-image: url({{ asset('assets/frontend/img/bg/7.png') }});">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="page-title">About Us</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="page-list">
                            <li><a href="index.html">Home</a></li>
                            <li>Blog Post</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-area pd-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-thumb-inner pe-xl-5 me-xl-5">
                        <img class="animate-img-1 top_image_bounce" src="{{ asset('assets/frontend/img/about/2.png') }}" alt="img">
                        <img class="animate-img-2 left_image_bounce" src="{{ asset('assets/frontend/img/about/3.png') }}" alt="img">
                        <img class="animate-img-3 top_image_bounce" src="{{ asset('assets/frontend/img/banner/5.svg') }}" alt="img">
                        <img class="main-img" src="{{ asset('storage/'. $about->image) }}" alt="img">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-title">
                        <h6 class="sub-title">ABOUT US</h6>
                        <h2 class="title">{{ $about->title }}</h2>
                        <p class="content mb-4 mb-xl-5">
                          {!! $about->content  !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="team-area bg-relative pd-top-120 pd-bottom-90">
        <div class="container">
            <div class="section-title text-center">
                <h6 class="sub-title">MEET OUR EXPERTS</h6>
                <h2 class="title">Your Partner In <span>Digital</span> Success</h2>
            </div>
            <div class="row">
                @foreach ($team as $teams)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-team-inner text-center">
                            <div class="thumb team-member-image">
                                <img src="{{ asset('storage/' . $teams->image) }}" alt="{{ $teams->name }}">
                                @if ($teams->instagram || $teams->facebook || $teams->x)
                                <ul class="team-social-inner">
                                    @if ($teams->instagram)
                                        <li><a href="{{ $teams->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if ($teams->facebook)
                                        <li><a href="{{ $teams->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                    @endif
                                    @if ($teams->x)
                                        <li><a href="{{ $teams->x }}"><i class="fab fa-x-twitter"></i></a></li>
                                    @endif
                                </ul>
                                @endif
                            </div>
                            <div class="details">
                                <h5><a href="#">{{ $teams->name }}</a></h5>
                                <p>{{ $teams->position->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <center>
              <a class="btn btn-border-base" href="{{ route('team.index') }}">Discover More <i class="fa fa-plus"></i></a>
            </center>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .team-member-image {
        height: 410px;
        overflow: hidden;
        border-radius: 12px;
    }

    .team-member-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top;
        display: block;
    }
</style>
@endpush
