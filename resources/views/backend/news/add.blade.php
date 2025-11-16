@extends('backend.layouts.app')

@push('styles')
<style>
    .ck-editor__editable_inline {
        min-height: 600px;
    }
</style>
@endpush

@section('content')
<div id="Content" class="relative flex flex-col flex-1 gap-6 p-6 pb-[30px] w-full shrink-0">
    <div id="Header" class="flex items-center justify-between">
        <div class="flex flex-col gap-2">
            <div class="flex gap-1 items-center leading-5 text-desa-secondary">
                <p class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize">Berita</p>
                <span>/</span>
                <p class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize">Tambah Berita</p>
            </div>
            <h1 class="font-semibold text-2xl">Tambah Berita Baru</h1>
        </div>
    </div>
    @if ($errors->any())
    <div class="flex flex-col gap-2 p-4 rounded-2xl bg-desa-red/10">
        @foreach ($errors->all() as $error)
        <p class="font-medium text-desa-red">{{ $error }}</p>
        @endforeach
    </div>
    @endif
    <form action="{{ route('backend.news.store') }}" method="POST" enctype="multipart/form-data" class="capitalize">
        @csrf
        <div class="shrink-0 rounded-3xl p-6 bg-white flex flex-col gap-6 h-fit">
            <section id="Photos" class="flex justify-between">
                <h2 class="font-medium leading-5 text-desa-secondary flex h-[100px] items-center w-[calc(424/904*100%)]">Thumbnail Berita</h2>
                <div class="photo-input-container flex flex-col gap-6 flex-1">
                    <div class="photo-form group/parent flex items-center justify-between">
                        <div class="Photo-Preview flex items-center justify-center w-[120px] h-[100px] rounded-2xl overflow-hidden bg-desa-foreshadow">
                            <img class="Photo size-full object-cover" src="{{ asset('assets/backend/images/thumbnails/thumbnail-bansos-preview.svg') }}" alt="image" />
                        </div>
                        <div class="relative">
                            <input type="file" name="image" accept="image/*" class="photo-input absolute opacity-0 left-0 top-0 size-0 -z-10" />
                            <div class="action flex gap-3">
                                <button type="button" class="Upload-btn relative flex items-center py-4 px-6 rounded-2xl bg-desa-black gap-[10px]">
                                    <img src="{{ asset('assets/backend/images/icons/send-square-white.svg') }}" alt="icon" class="size-6 shrink-0" />
                                    <p class="font-medium leading-5 text-white">Upload</p>
                                </button>
                            </div>
                        </div>
                    </div>
                    @error('thumbnail')
                    <p class="text-sm text-desa-red">{{ $message }}</p>
                    @enderror
                </div>
            </section>
            <hr class="border-desa-background" />
            <section id="Judul-Berita" class="flex items-center justify-between">
                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Judul Berita</p>
                <div class="flex flex-col gap-1 flex-1 shrink-0">
                    <label class="relative group peer w-full">
                        <input type="text" name="title" placeholder="Masukan Judul Berita"  value="{{ old('name') }}" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                        <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                            <img src="{{ asset('assets/backend/images/icons/user-secondary-green.svg') }}" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                            <img src="{{ asset('assets/backend/images/icons/user-black.svg') }}" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                        </div>
                        <img src="{{ asset('assets/backend/images/icons/Checklist-dark-green-fill.svg') }}" class="absolute transform -translate-y-1/2 top-1/2 right-4 size-6 shrink-0 hidden group-[.valid]:flex" alt="icon">
                    </label>
                    @error('name')
                    <p class="text-sm text-desa-red">{{ $message }}</p>
                    @enderror
                </div>
            </section>
            <hr class="border-desa-background w-[calc(100%+48px)] -mx-6" />
            <section id="Isi-Berita" class="flex flex-col gap-4">
                <p class="font-medium leading-5">Isi Berita</p>
                <div class="flex flex-col gap-1 flex-1 shrink-0">
                    <textarea name="content" id="content-editor" class="w-full">{{ old('content') }}</textarea>
                    @error('content')
                    <p class="text-sm text-desa-red">{{ $message }}</p>
                    @enderror
                </div>
            </section>
            <hr class="border-desa-background" />
            <section id="Buttons" class="flex items-center justify-end gap-4">
                <a href="{{ route('backend.news.index') }}" class="py-[18px] rounded-2xl bg-desa-red w-[180px] text-center flex justify-center font-medium text-white">Batal, Tidak jadi</a>
                <button id="submitButton" type="submit" class="py-[18px] rounded-2xl bg-desa-dark-green w-[180px] text-center flex justify-center font-medium text-white transition-all duration-300">Create Now</button>
            </section>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@41.4.2/build/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const uploadButton = document.querySelector('.Upload-btn');
        const fileInput = document.querySelector('.photo-input');
        const photoPreview = document.querySelector('.Photo');

        uploadButton.addEventListener('click', function () {
            fileInput.click();
        });

        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    photoPreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        ClassicEditor
            .create(document.querySelector('#content-editor'), {
                ckfinder: {
                    uploadUrl: "{{ route('uploadCkeditorImage') . '?_token=' . csrf_token() }}",
                }
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endpush
