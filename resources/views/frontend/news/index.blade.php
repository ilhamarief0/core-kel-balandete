@extends('frontend.layouts.app')
@section('content')
    <!-- page title start -->
    <div class="breadcrumb-area bg-cover" style="background-image: url('{{ asset('assets/frontend/img/bg/7.png') }}');">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="page-title">News</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="page-list">
                            <li><a href="index.html">Home</a></li>
                            <li>News</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title end -->

    <!-- blog area start -->
    <div class="blog-area pd-top-120 pd-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @foreach ($news as $newsItem)
                        <div class="single-blog-inner">
                            <div class="thumb">
                                <img src="{{ asset('storage/'. $newsItem->image) }}" alt="img" class="responsive-image">
                                <span class="date">15 DEC</span>
                            </div>
                            <div class="details">
                                <ul class="blog-meta">
                                    <li><i class="far fa-user"></i> By Admin</li>
                                    <li><i class="far fa-folder-open"></i> Category</li>
                                </ul>
                                <h2 class="title"><a href="blog-details.html">{{ $newsItem->title }}</a></h2>
                                <p>
                                    <?php
                                        $contentWithoutImages = preg_replace('/<img[^>]*>/i', '', $newsItem->content);
                                        $cleanContent = strip_tags($contentWithoutImages);
                                    ?>
                                    {{ Str::limit($cleanContent, 30) }}
                                </p>
                                <a class="btn btn-border-base mt-3" href="{{ route('news.detail', Str::slug($newsItem->title)) }}">Touch More <i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    @endforeach
                    <div class="pagination-container"> {{-- Tambahkan wrapper untuk kontrol yang lebih baik --}}
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog area end -->
@endsection

@push('styles')
<style>
.thumb {
    width: 850px; /* Ukuran container */
    height: 480px; /* Ukuran container */
    overflow: hidden; /* Penting untuk menyembunyikan bagian gambar yang terpotong */
}

.responsive-image {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ini yang membuat gambar tidak gepeng */
}

/* Styling untuk pagination Laravel yang diperbaiki */
.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 40px; /* Tambah jarak atas */
    padding: 15px 0;
}

.pagination { /* Ini adalah class 'ul' yang dihasilkan Laravel */
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    border-radius: 8px; /* Sudut lebih membulat untuk keseluruhan pagination */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Tambah bayangan lembut */
    overflow: hidden; /* Pastikan bayangan dan border-radius bekerja dengan baik */
}

.pagination li { /* Ini adalah class 'li' yang dihasilkan Laravel */
    margin: 0; /* Hapus margin antar item untuk tampilan yang menyatu */
}

.pagination li .page-link,
.pagination li span { /* Ini adalah class 'a' atau 'span' yang dihasilkan Laravel */
    display: block;
    padding: 10px 18px; /* Sesuaikan padding */
    border: none; /* Hapus border individu, gunakan border pada container ul */
    color: #555;
    text-decoration: none;
    transition: all 0.3s ease;
    background-color: #fff;
    font-weight: 500;
    line-height: 1; /* Pastikan teks terpusat vertikal */
}

.pagination li:first-child .page-link,
.pagination li:first-child span {
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
}

.pagination li:last-child .page-link,
.pagination li:last-child span {
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
}

.pagination li .page-link:hover {
    background-color: #f0f0f0;
    color: #007bff;
}

.pagination li.active .page-link,
.pagination li.active span { /* Class 'active' untuk halaman saat ini */
    background-color: #007bff; /* Warna biru untuk halaman aktif */
    color: #fff;
    border-color: #007bff;
    cursor: default;
}

.pagination li.disabled .page-link,
.pagination li.disabled span { /* Class 'disabled' untuk tombol sebelumnya/selanjutnya yang tidak aktif */
    color: #ccc;
    background-color: #f8f8f8;
    cursor: not-allowed;
}

/* Styling untuk icon panah */
.pagination li .page-link i {
    vertical-align: middle;
}
</style>
@endpush
