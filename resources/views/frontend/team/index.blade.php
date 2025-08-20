@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumb-area bg-cover" style="background-image: url({{ asset('assets/frontend/img/bg/7.png') }});">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="page-title">Our Team</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="page-list">
                            <li><a href="index.html">Home</a></li>
                            <li>Our Team</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="team-area bg-relative pd-top-120 pd-bottom-90">
        <div class="container">
            {{-- Tampilkan Anggota Tim yang Dikelompokkan berdasarkan Divisi --}}
            @foreach ($divisions as $division)
                <div class="division-section mt-5">
                    <div class="section-title text-center mb-5">
                        <h6 class="sub-title">MEET OUR EXPERTS IN</h6>
                        <h2 class="title">{{ $division->name }}</h2>
                    </div>
                    {{-- Tambahkan justify-content-center di sini untuk baris utama --}}
                    <div class="row justify-content-center">
                        @foreach ($division->jabatans as $jabatan)
                            @include('frontend.team.partials.jabatan_team_display', ['jabatan' => $jabatan, 'level' => 0])
                        @endforeach
                    </div>
                </div>
            @endforeach

            {{-- Tampilkan Anggota Tim Tanpa Divisi (jika ada jabatan yang tidak punya divisi) --}}
            @if (count($jabatansWithoutDivision) > 0)
                <div class="division-section mt-5">
                    <div class="section-title text-center mb-5">
                        <h6 class="sub-title">MEET OUR EXPERTS IN</h6>
                        <h2 class="title">Team Tanpa Divisi</h2>
                    </div>
                    {{-- Tambahkan justify-content-center di sini untuk baris utama --}}
                    <div class="row justify-content-center">
                        @foreach ($jabatansWithoutDivision as $jabatan)
                            @include('frontend.team.partials.jabatan_team_display', ['jabatan' => $jabatan, 'level' => 0])
                        @endforeach
                    </div>
                </div>
            @endif

            <center class="mt-5">
                <a class="btn btn-border-base" href="{{ route('about.index') }}">Discover More <i class="fa fa-plus"></i></a>
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

    /* Styling untuk judul divisi (sekarang menggunakan section-title) */
    .section-title.text-center .title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }
    .section-title.text-center .sub-title {
        font-size: 1rem;
        color: #666;
        margin-bottom: 5px;
    }

    /* Styling untuk judul jabatan dalam tampilan tim */
    .position-title {
        font-weight: 600;
        color: #555;
        margin-top: 20px;
        margin-bottom: 15px;
    }

    /* Spasi umum untuk anggota tim */
    .single-team-inner {
        margin-bottom: 30px;
    }

    /* Kelas untuk indentasi dinamis */
    .indent-level-0 { padding-left: 0px; }
    .indent-level-1 { padding-left: 20px; }
    .indent-level-2 { padding-left: 40px; }
    .indent-level-3 { padding-left: 60px; }
    .indent-level-4 { padding-left: 80px; }
    /* Tambahkan lebih banyak level jika kedalaman jabatan Anda lebih dari 4 */
</style>
@endpush

