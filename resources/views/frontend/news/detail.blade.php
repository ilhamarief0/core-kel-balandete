@extends('frontend.layouts.app')

@section('content')

{{-- Hero Section --}}
<div class="bg-gray-50">
    <div class="container max-w-[1130px] mx-auto pt-16 pb-12 px-4">
        {{-- Breadcrumb --}}
        <div class="breadcrumb flex items-center justify-center gap-2 text-sm text-gray-500">
            <a href="/" class="hover:text-cp-dark-blue transition-colors duration-300">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('news.index') }}" class="hover:text-cp-dark-blue transition-colors duration-300">Blog</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
            <p class="font-semibold text-cp-black truncate sm:max-w-none max-w-xs text-center">{{ $news->title }}</p>
        </div>

        {{-- Title --}}
        <h1 class="font-extrabold text-3xl md:text-5xl leading-tight text-center mt-6 text-gray-900">{{ $news->title }}</h1>

        {{-- Meta Info --}}
        <div class="flex items-center justify-center gap-4 mt-6 text-gray-500">
            <span>Oleh <strong>BalandeteKu</strong></span>
            <span class="text-gray-300">|</span>
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>{{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('d F Y') }}</span>
            </div>
        </div>
        @php
            $shareUrl = urlencode(url()->current());
            $shareTitle = urlencode($news->title);
            $shareText = urlencode($news->title . ' - ' . url()->current());
        @endphp
    </div>
</div>

<div class="container max-w-[1130px] mx-auto px-4 py-16">
    <div class="w-full h-auto md:h-[550px] rounded-2xl overflow-hidden shadow-xl mb-16">
        <img src="{{ asset('storage/'. $news->image ) }}" class="w-full h-full object-cover" alt="{{ $news->title }}">
    </div>

    <article class="prose lg:prose-xl max-w-4xl mx-auto">
        {!! $news->content !!}
    </article>

    <hr class="my-12">

    {{-- Share Buttons at the end --}}
    <div class="mt-8 text-center">
        <p class="font-semibold text-gray-800 mb-4">Suka dengan artikel ini? Bagikan sekarang:</p>
        <div class="flex items-center justify-center gap-3">
            <a href="https://api.whatsapp.com/send?text={{ $shareText }}" target="_blank" title="Bagikan ke WhatsApp" class="w-11 h-11 flex items-center justify-center bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors duration-300">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M16.6 14.2c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1-.2.2-.6.7-.8.9-.1.1-.3.1-.5.0s-1.1-.4-2-1.2c-.8-.7-1.3-1.5-1.5-1.8-.2-.3-.0-.4.1-.5.1-.1.2-.2.4-.4.1-.1.2-.2.2-.4.1-.1.0-.3 0-.4-.1-.1-.6-1.5-.8-2-.2-.5-.4-.4-.5-.4h-.5c-.2 0-.4.1-.6.3s-.8.8-.8 1.9.9 2.2 1 2.4c.1.1 1.5.7 1.7.8.2.1 1.1 1.7 2.6 2.3.4.2.7.3.9.4.5.2 1 .1 1.3-.1.4-.2.6-.7.8-.9.1-.1.1-.3 0-.4l-.2-.2zM12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm0 18c-4.4 0-8-3.6-8-8s3.6-8 8-8 8 3.6 8 8-3.6 8-8 8z"/></svg>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" title="Bagikan ke Facebook" class="w-11 h-11 flex items-center justify-center bg-blue-800 text-white rounded-full hover:bg-blue-900 transition-colors duration-300">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" title="Bagikan ke Twitter" class="w-11 h-11 flex items-center justify-center bg-sky-500 text-white rounded-full hover:bg-sky-600 transition-colors duration-300">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
            </a>
            <a href="https://t.me/share/url?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" title="Bagikan ke Telegram" class="w-11 h-11 flex items-center justify-center bg-sky-400 text-white rounded-full hover:bg-sky-500 transition-colors duration-300">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.17.9-.502 1.202-.823 1.23-.696.06-.99-.24-.99-.24l-2.434-1.823-1.182 1.124a.65.65 0 0 1-.402.173l.16-1.223 2.12-1.928 2.94-2.645c.25-.224.013-.35-.203-.213l-3.613 2.26-1.12.348a.638.638 0 0 1-.59-.193c-.153-.152-.224-.343-.224-.343l-.004-1.32 8.16-3.805z"/></svg>
            </a>
            <button title="Salin Tautan" class="copy-link-btn w-11 h-11 flex items-center justify-center bg-gray-500 text-white rounded-full hover:bg-gray-600 transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyButtons = document.querySelectorAll('.copy-link-btn');
        copyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const url = '{{ url()->current() }}';
                navigator.clipboard.writeText(url).then(function() {
                    alert('Tautan berhasil disalin!');
                }, function(err) {
                    alert('Gagal menyalin tautan.');
                });
            });
        });
    });
</script>

@endsection
