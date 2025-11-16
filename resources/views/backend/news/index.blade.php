@extends('backend.layouts.app')
@section('content')
                <div id="Content" class="relative flex flex-col flex-1 gap-6 p-6 pb-[30px] w-full shrink-0">
                    <div id="Header" class="flex items-center justify-between">
                        <h1 class="font-semibold text-2xl">List Berita</h1>
                        <a href="{{ route('backend.news.create') }}" class="flex items-center rounded-2xl py-4 px-6 gap-[10px] bg-desa-dark-green">
                            <img src="{{ asset('assets/backend/images/icons/add-square-white.svg') }}" class="flex size-6 shrink-0" alt="icon">
                            <p class="font-medium text-white">Add New</p>
                        </a>
                    </div>
                    <section id="List-Bantuan-Sosial" class="flex flex-col gap-[14px]">
                        <form id="Page-Search" class="flex items-center justify-between">
                            <div class="flex flex-col gap-3 w-[370px] shrink-0">
                                <label class="relative group peer w-full valid">
                                    <input type="text" placeholder="Cari Berita" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 pl-12 pr-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                                    <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                        <img src="{{ asset('assets/backend/images/icons/receipt-search-secondary-green.svg') }}" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                        <img src="{{ asset('assets/backend/images/icons/receipt-search-black.svg') }}" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                                    </div>
                                </label>
                            </div>
                            <div class="options flex items-center gap-4">
                                <div class="flex items-center gap-[10px]">
                                    <span class="font-medium leading-5">Show</span>
                                    <div class="relative">
                                        <select name="" id="" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 pr-[52px] gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                                            <option value="5" selected>5 Entries</option>
                                            <option value="10">10 Entries</option>
                                            <option value="20">20 Entries</option>
                                            <option value="30">30 Entries</option>
                                            <option value="40">40 Entries</option>
                                            <option value="50">50 Entries</option>
                                        </select>
                                        <img src="{{ asset('assets/backend/images/icons/arrow-down-black.svg') }}" class="flex size-6 shrink-0 absolute transform -translate-y-1/2 top-1/2 right-6" alt="icon">
                                    </div>
                                </div>
                                <button type="button" class="flex items-center gap-1 h-14 w-fit rounded-2xl border border-desa-background bg-white py-4 px-6">
                                    <img src="{{ asset('assets/backend/images/icons/filter-black.svg') }}" class="flex size-6 shrink-0" alt="icon">
                                    <span class="font-medium leading-5">Filter</span>
                                </button>
                            </div>
                        </form>
                        @foreach ($news as $newsItem)
                        <div class="card flex flex-col gap-6 rounded-3xl p-6 bg-white">
                            <div class="flex items-center w-full">
                                <div class="flex w-[100px] h-20 shrink-0 rounded-2xl overflow-hidden bg-desa-foreshadow">
                                    <img src="{{ asset('storage/'. $newsItem->image) }}" class="w-full h-full object-cover" alt="photo">
                                </div>
                                <div class="flex flex-col gap-[6px] w-full ml-4 mr-9">
                                    <p class="font-semibold text-lg leading-[22.5px] line-clamp-1">{{ $newsItem->title }}</p>
                                    <p class="flex items-center gap-1">
                                        <img src="{{ asset('assets/backend/images/icons/profile-secondary-green.svg') }}" class="flex size-[18px] shrink-0" alt="icon">
                                        <span class="font-medium text-sm text-desa-secondary">Created At: {{ $newsItem->created_at }}</span>
                                    </p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('backend.news.edit', $newsItem->id) }}" class="flex items-center justify-center p-3 rounded-full bg-desa-foreshadow hover:bg-yellow-100 transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-500">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('backend.news.destroy', $newsItem->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center justify-center p-3 rounded-full bg-desa-foreshadow hover:bg-red-100 transition-all duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </section>
                    <nav id="Pagination">
                        {{ $news->links('backend.vendor.pagination.custom') }}
                    </nav>
                </div>
@endsection
