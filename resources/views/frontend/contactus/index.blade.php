@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumb-area bg-cover" style="background-image: url({{ asset('assets/frontend/img/bg/7.png') }});">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="page-title">Contact</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="page-list">
                            <li><a href="index.html">Home</a></li>
                            <li>Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-area pd-top-120 pd-bottom-120">
        <div class="container">
            <div class="contact-page-inner bg-gray">
                <div class="section-title mb-4 pb-2">
                    <h2 class="title">Direct contact us? </h2>
                    <p class="content mb-0">For your car we will do everything advice, repairs and maintenance. We are the some preferred choice by many car owners because our experience and knowledge is selfe vident.For your car we will do som everything.</p>
                </div>
                <form id="contactForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="single-input-inner">
                                <input type="text" name="name" id="name" placeholder="Your Name" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-input-inner">
                                <input type="email" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-input-inner">
                                <input type="text" name="contact" id="contact" placeholder="Your Contact" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-input-inner">
                                <textarea placeholder="Message" name="message" id="message" required></textarea>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-base border-radius-5">Post Comment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="contact-page-list">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="media single-contact-list">
                        <div class="media-left">
                            <img src="{{ asset('assets/frontend/img/icon/13.svg') }}" alt="img">
                        </div>
                        <div class="media-body">
                            <h5>Contacts us</h5>
                            <h6>{{ $websiteSetting->website_phone }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="media single-contact-list">
                        <div class="media-left">
                            <img src="{{ asset('assets/frontend/img/icon/14.svg') }}" alt="img">
                        </div>
                        <div class="media-body">
                            <h5>Your Email</h5>
                            <h6>{{ $websiteSetting->website_email }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="media single-contact-list">
                        <div class="media-left">
                            <img src="{{ asset('assets/frontend/img/icon/15.svg') }}" alt="img">
                        </div>
                        <div class="media-body">
                            <h5>Location</h5>
                            <h6>{{ $websiteSetting->website_address }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-g-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d41458.4826902408!2d122.51087940058589!3d-4.017457540184249!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sid!2sid!4v1751432495028!5m2!1sid!2sid"></iframe>
    </div>
    @endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const name = formData.get('name');
        const email = formData.get('email');
        const contact = formData.get('contact');
        const message = formData.get('message');

        if (!name || !email || !contact || !message) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'All fields are required!',
                confirmButtonText: 'OK'
            });
            return;
        }

        fetch('/contactus/submit', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    confirmButtonText: 'OK'
                }).then(() => {
                    document.getElementById('contactForm').reset();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: data.message || 'Something went wrong!',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'There was an error submitting your form. Please try again later.',
                confirmButtonText: 'OK'
            });
        });
    });
</script>
@endpush
