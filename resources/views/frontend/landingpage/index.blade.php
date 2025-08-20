@extends('frontend.layouts.app')
@section('content')
<div class="custom-banner-slider-container">
    <div class="custom-slider-wrapper">
        @foreach ($banner as $index => $banners)
        <div class="custom-slider-item" style="background-image: url('{{ asset('storage/'. $banners->image) }}');">
            <div class="overlay-fade-bottom"></div>
            <div class="overlay-text-background"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 pb-xl-6 align-self-center text-center">
                        <div class="banner-inner pe-xl-4 pb-5">
                            <h6 class="bg-none text-white wow animated fadeInLeft mb-2" data-wow-duration="1.5s" data-wow-delay="0.3s">{{ $banners->subtitle ?? 'Selamat Datang Di Website' }}</h6>
                            <h2 class="title text-white wow animated fadeInLeft" data-wow-duration="1.5s" data-wow-delay="0.4s">{{ $websiteName }}</h2>
                            <p class="content text-white pe-xl-4 wow animated fadeInLeft" data-wow-duration="1.5s" data-wow-delay="0.5s">{{ $websiteDescription }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <button class="slider-prev"><i class="fa fa-angle-left"></i></button>
    <button class="slider-next"><i class="fa fa-angle-right"></i></button>
    <div class="slider-dots"></div>
</div>
    <div class="about-area pd-top-120 pd-bottom-120">
        <div class="container">
            <div class="row">
              <div class="col-lg-6 mb-4 mb-lg-0 wow animated fadeInLeft" data-wow-duration="1.5s" data-wow-delay="0.3s">
                  <div class="about-thumb-inner">
                      <img class="main-img top_image_bounce" src="{{ asset('storage/'. $about->image) }}" alt="img" style="height: 492px; width: auto;">
                  </div>
              </div>
                <div class="col-lg-6 wow animated fadeInRight" data-wow-duration="1.5s" data-wow-delay="0.3s">
                    <div class="section-title mb-0">
                        <h6 class="sub-title">ABOUT US</h6>
                        <h2 class="title">{{ $about->title }}</h2>
                        {{-- <p class="content mb-4">You can access SaaS applications through a web browser or mobile app, as long as you have an internet connection.</p> --}}
                        <p class="content">
                          {!! $about->content !!}
                        </p>
                        <a class="btn btn-border-base" href="{{ route('about.index') }}">Discover More <i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="work-process-area pd-top-120">
        <div class="container">
            <div class="section-title text-center pb-5">
                <h6 class="sub-title">OUR SIMPLE PROCESS</h6>
                <h2 class="title">World <span>Best Step</span> Our It Process</h2>
            </div>
            <div class="work-process-area-inner bg-gray border-radius-20">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="single-work-process-inner-2 text-center">
                            <div class="thumb mb-3">
                                <img src="{{ asset('assets/frontend/img/icon/20.svg') }}" alt="img">
                                <p class="process-count">01</p>
                            </div>
                            <div class="details">
                                <h5 class="mb-3">Requirements</h5>
                                <p class="content">Research ipsum dolor sit consec tetur sed diam in the aliquam tempor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-work-process-inner-2 text-center">
                            <div class="thumb mb-3">
                                <img src="{{ asset('assets/frontend/img/icon/21.svg') }}" alt="img">
                                <p class="process-count">02</p>
                            </div>
                            <div class="details">
                                <h5 class="mb-3">planning</h5>
                                <p class="content">Create ipsum dolor sit consec tetur sed diam in the aliquam tempor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-work-process-inner-2 text-center">
                            <div class="thumb mb-3">
                                <img src="{{ asset('assets/frontend/img/icon/22.svg') }}" alt="img">
                                <p class="process-count">03</p>
                            </div>
                            <div class="details">
                                <h5 class="mb-3">Implementation</h5>
                                <p class="content">Develope ipsum dolor sit consec tetur sed diam in the aliquam tempor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-work-process-inner-2 text-center">
                            <div class="thumb mb-3">
                                <img src="{{ asset('assets/frontend/img/icon/23.svg') }}" alt="img">
                                <p class="process-count">04</p>
                            </div>
                            <div class="details">
                                <h5 class="mb-3">Maintenance</h5>
                                <p class="content">Shop ipsum dolor sit consec tetur Malesuada sed diam in the</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="testimonial-area pd-top-120 pd-bottom-90" style="background-image: url('{{ asset('assets/frontend/img/bg/11.png') }}');">
     <div class="container">
         <div class="section-title">
             <h6 class="sub-title">TESTIMONIAL</h6>
             <h2 class="title">Advanced Engine Services</h2>
         </div>
         <div class="testimonial-slider-1 owl-carousel slider-control-round slider-control-dots slider-control-right-top">
             <div class="item">
                 <div class="single-work-process-inner-2 text-center">
                     <div class="thumb mb-3">
                         <img src="{{ asset('assets/frontend/img/icon/20.svg') }}" alt="img">
                         <p class="process-count">01</p>
                     </div>
                     <div class="details">
                         <h5 class="mb-3">Requirements</h5>
                         <p class="content">Research ipsum dolor sit consec tetur sed diam in the aliquam tempor</p>
                         <a class="btn btn-base" href="#">Learn More</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
    <div class="service-area bg-gray bg-relative pd-top-120 pd-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h6 class="sub-title">ADVANCED SERVICES</h6>
                        <h2 class="title">Optimize Your <span>Performance</span> With Saas</h2>
                    </div>
                </div>
            </div>
            <div class="row">
              @foreach ($service as $services)
              <div class="col-lg-4 col-md-6">
                  <div class="single-service-inner-2 text-center">
                      <div class="thumb">
                          <img src="{{ asset('storage/'. $services->image) }}" alt="img">
                      </div>
                      <div class="details">
                          <div class="icon mb-3">
                              <img src="{{ asset('assets/frontend/img/service/8.png') }}" alt="img">
                          </div>
                          <h5><a href="{{ route('service.index', Str::slug($services->title)) }}">{{ $services->title }}</a></h5>
                          <p>SaaS stands for Software as a Service. It is a software</p>
                      </div>
                  </div>
              </div>
              @endforeach
            </div>
        </div>
    </div>
    <div class="work-process-area pd-top-120">
        <div class="container">
            <div class="section-title text-center pb-5">
                <h6 class="sub-title">OUR SIMPLE PROCESS</h6>
                <h2 class="title">World <span>Best Step</span> Our It Process</h2>
            </div>
            <div class="work-process-area-inner bg-gray border-radius-20">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="single-work-process-inner-2 text-center">
                            <div class="thumb mb-3">
                                <img src="{{ asset('assets/frontend/img/icon/20.svg') }}" alt="img">
                                <p class="process-count">01</p>
                            </div>
                            <div class="details">
                                <h5 class="mb-3">Requirements</h5>
                                <p class="content">Research ipsum dolor sit consec tetur sed diam in the aliquam tempor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-work-process-inner-2 text-center">
                            <div class="thumb mb-3">
                                <img src="{{ asset('assets/frontend/img/icon/21.svg') }}" alt="img">
                                <p class="process-count">02</p>
                            </div>
                            <div class="details">
                                <h5 class="mb-3">planning</h5>
                                <p class="content">Create ipsum dolor sit consec tetur sed diam in the aliquam tempor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-work-process-inner-2 text-center">
                            <div class="thumb mb-3">
                                <img src="{{ asset('assets/frontend/img/icon/22.svg') }}" alt="img">
                                <p class="process-count">03</p>
                            </div>
                            <div class="details">
                                <h5 class="mb-3">Implementation</h5>
                                <p class="content">Develope ipsum dolor sit consec tetur sed diam in the aliquam tempor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-work-process-inner-2 text-center">
                            <div class="thumb mb-3">
                                <img src="{{ asset('assets/frontend/img/icon/23.svg') }}" alt="img">
                                <p class="process-count">04</p>
                            </div>
                            <div class="details">
                                <h5 class="mb-3">Maintenance</h5>
                                <p class="content">Shop ipsum dolor sit consec tetur Malesuada sed diam in the</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="testimonial-area pd-top-120 pd-bottom-90" style="background-image: url('{{ asset('assets/frontend/img/bg/11.png') }}');">
        <div class="container">
            <div class="section-title">
                <h6 class="sub-title">TESTIMONIAL</h6>
                <h2 class="title">Advanced Engine Services</h2>
            </div>
            <div class="testimonial-slider-1 owl-carousel slider-control-round slider-control-dots slider-control-right-top">
                <div class="item">
                    <div class="single-testimonial-inner style-1 text-center">
                        <h5>Devon Lane</h5>
                        <p class="designation mb-3">Marketing Coordinator</p>
                        <div class="icon mb-2">
                            <img src="{{ asset('assets/frontend/img/icon/25.png') }}" alt="img">
                        </div>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC</p>
                        <div class="ratting-inner mt-4">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="thumb">
                            <img src="{{ asset('assets/frontend/img/testimonial/1.png') }}" alt="img">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="single-testimonial-inner style-1 text-center">
                        <h5>Devon Lane</h5>
                        <p class="designation mb-3">Marketing Coordinator</p>
                        <div class="icon mb-2">
                            <img src="{{ asset('assets/frontend/img/icon/25.png') }}" alt="img">
                        </div>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC</p>
                        <div class="ratting-inner mt-4">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="thumb">
                            <img src="{{ asset('assets/frontend/img/testimonial/2.png') }}" alt="img">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="single-testimonial-inner style-1 text-center">
                        <h5>Devon Lane</h5>
                        <p class="designation mb-3">Marketing Coordinator</p>
                        <div class="icon mb-2">
                            <img src="{{ asset('assets/frontend/img/icon/25.png') }}" alt="img">
                        </div>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC</p>
                        <div class="ratting-inner mt-4">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="thumb">
                            <img src="{{ asset('assets/frontend/img/testimonial/3.png') }}" alt="img">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="single-testimonial-inner style-1 text-center">
                        <h5>Devon Lane</h5>
                        <p class="designation mb-3">Marketing Coordinator</p>
                        <div class="icon mb-2">
                            <img src="{{ asset('assets/frontend/img/icon/25.png') }}" alt="img">
                        </div>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC</p>
                        <div class="ratting-inner mt-4">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="thumb">
                            <img src="{{ asset('assets/frontend/img/testimonial/1.png') }}" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-area pd-top-120 pd-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h6 class="sub-title">RECENT BLOG</h6>
                        <h2 class="title">Discover a World of Sustainable Alternatives</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($news as $newsItem)
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog-list style-2">
                        <div class="thumb">
                            <img src="{{ asset('storage/'. $newsItem->image) }}" alt="img">
                        </div>
                        <div class="details">
                            <ul class="blog-meta">
                                <li class="date">15 MAY</li>
                                <li><i class="far fa-user"></i> By Admin</li>
                            </ul>
                            <h5 class="mb-3"><a href="{{ route('news.detail', Str::slug($newsItem->title)) }}">{{ $newsItem->title }}</a></h5>
                            <a class="read-more-text" href="{{ route('news.detail', Str::slug($newsItem->title)) }}">Discover More <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('style')
<style>
    .custom-banner-slider-container {
        position: relative;
        overflow: hidden;
    }

    .custom-slider-wrapper {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .custom-slider-item {
        flex: 0 0 100%;
        max-width: 100%;
        height: 100vh;
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        position: relative;
        overflow: hidden;
        transition: transform 6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        transform: scale(1);
    }

    .custom-slider-item.active {
        transform: scale(1.05);
    }

    .custom-slider-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 0;
    }

    .overlay-fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 350px;
        background: linear-gradient(to top, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.8) 20%, rgba(255, 255, 255, 0) 100%);
        pointer-events: none;
        z-index: 1;
    }

    .overlay-text-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    .custom-slider-item .container {
        position: relative;
        z-index: 2;
    }

    .custom-slider-item .banner-inner {
        padding: 0 15px;
    }

    .custom-slider-item h6 {
        font-size: 1.2em;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 20px !important;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        font-size: 1.5em;
    }

    .custom-slider-item h2 {
        font-size: 3em;
        margin-bottom: 20px;
        line-height: 1.2;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.9);
        font-weight: bold;
    }

    .custom-slider-item p {
        font-size: 1.1em;
        margin-bottom: 30px;
        line-height: 1.6;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
        font-size: 1.2em;
        max-width: 80%;
        margin: 0 auto 20px auto;
    }

    .custom-slider-item .btn {
        padding: 12px 25px;
        font-size: 1em;
        border-radius: 5px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .slider-prev,
    .slider-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 15px;
        cursor: pointer;
        z-index: 10;
        font-size: 1.5em;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s ease;
    }

    .slider-prev:hover,
    .slider-next:hover {
        background: rgba(0, 0, 0, 0.8);
    }

    .slider-prev {
        left: 20px;
    }

    .slider-next {
        right: 20px;
    }

    .slider-dots {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 10;
    }

    .slider-dots .dot {
        width: 10px;
        height: 10px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .slider-dots .dot.active {
        background: white;
    }

    .custom-slider-item.active .wow.animated {
        visibility: visible;
        animation-name: none;
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @media (max-width: 991px) {
        .custom-slider-item {
            height: 80vh;
        }
        .custom-slider-item h2 {
            font-size: 2.5em;
        }
        .custom-slider-item p {
            font-size: 1em;
        }
        .overlay-fade-bottom {
            height: 250px;
        }
    }

    @media (max-width: 767px) {
        .custom-slider-item {
            height: 70vh;
        }
        .custom-slider-item h2 {
            font-size: 2em;
        }
        .custom-slider-item h6 {
            font-size: 1em;
        }
        .custom-slider-item p {
            font-size: 0.9em;
        }
        .slider-prev,
        .slider-next {
            padding: 10px;
            width: 40px;
            height: 40px;
            font-size: 1.2em;
        }
        .slider-prev {
            left: 10px;
        }
        .slider-next {
            right: 10px;
        }
        .overlay-fade-bottom {
            height: 200px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sliderWrapper = document.querySelector('.custom-slider-wrapper');
        const sliderItems = document.querySelectorAll('.custom-slider-item');
        const prevButton = document.querySelector('.slider-prev');
        const nextButton = document.querySelector('.slider-next');
        const dotsContainer = document.querySelector('.slider-dots');
        let currentIndex = 0;
        let autoSlideInterval;

        const totalItems = sliderItems.length;

        for (let i = 0; i < totalItems; i++) {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            dot.dataset.index = i;
            dotsContainer.appendChild(dot);
            dot.addEventListener('click', () => {
                goToSlide(i);
            });
        }

        const dots = document.querySelectorAll('.slider-dots .dot');

        const updateSlider = () => {
            sliderWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;

            sliderItems.forEach((item, index) => {
                if (index === currentIndex) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });

            dots.forEach((dot, index) => {
                if (index === currentIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });

            sliderItems.forEach((item, index) => {
                const wowElements = item.querySelectorAll('.wow');
                wowElements.forEach(el => {
                    el.classList.remove('animated', 'fadeInLeft');
                    void el.offsetWidth;
                });

                if (index === currentIndex) {
                    wowElements.forEach(el => {
                        const delay = parseFloat(el.dataset.wowDelay || '0s') * 1000;
                        setTimeout(() => {
                            el.classList.add('animated', 'fadeInLeft');
                        }, 50 + delay);
                    });
                }
            });
        };

        const goToSlide = (index) => {
            currentIndex = index;
            if (currentIndex >= totalItems) {
                currentIndex = 0;
            } else if (currentIndex < 0) {
                currentIndex = totalItems - 1;
            }
            updateSlider();
            resetAutoSlide();
        };

        const nextSlide = () => {
            goToSlide(currentIndex + 1);
        };

        const prevSlide = () => {
            goToSlide(currentIndex - 1);
        };

        nextButton.addEventListener('click', nextSlide);
        prevButton.addEventListener('click', prevSlide);

        const startAutoSlide = () => {
            autoSlideInterval = setInterval(nextSlide, 5000);
        };

        const resetAutoSlide = () => {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        };

        updateSlider();
        startAutoSlide();

        sliderWrapper.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
        sliderWrapper.addEventListener('mouseleave', startAutoSlide);

        if (typeof WOW !== 'undefined') {
            new WOW().init();
        }
    });
</script>
@endpush
