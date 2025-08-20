@extends('frontend.layouts.app')
@section('content')
<div class="breadcrumb-area bg-cover" style="background-image: url('{{ asset('assets/frontend/img/bg/7.png') }}');">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="page-title">{{ $service->title }}</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="page-list">
                            <li><a href="index.html">Home</a></li>
                            <li>Service Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title end -->

    <!-- service area start -->
    <div class="service-area pd-top-120 pd-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="td-sidebar service-sidebar">

                        <div class="widget widget_download">
                            <h5 class="widget-title"><i class="fas fa-arrow-right"></i> Download</h5>
                            <ul>
                                <li><a href="#"> Company Profile <i class="fa fa-angle-double-right"></i></a></li>
                                <li><a href="#"> Zip File Download <i class="fa fa-angle-double-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog-details-page-content">
                        <div class="single-blog-inner mb-0">
                            <div class="thumb">
                                <img src="{{ asset('storage/'. $service->image) }}" alt="img">
                            </div>
                            <div class="details">
                               {!! $service->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service area end -->
@endsection
