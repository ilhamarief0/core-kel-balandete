@extends('backend.layouts.app')
@section('content')
    <div id="Content" class="relative flex flex-col flex-1 gap-6 p-6 pb-[30px] w-full shrink-0">
        <div id="Header" class="flex items-center justify-between">
            <h1 class="font-semibold text-2xl">Users List </h1>
            <a href="{{ route('backend.users.create') }}" class="flex items-center rounded-2xl py-4 px-6 gap-[10px] bg-desa-dark-green">
                <img src="{{ asset('assets/backend/images/icons/add-square-white.svg') }}" class="flex size-6 shrink-0" alt="icon">
                <p class="font-medium text-white">Add New</p>
            </a>
        </div>

        @if (session('success'))
            <div class="flex items-center p-4 rounded-2xl bg-desa-dark-green/10">
                <p class="font-medium text-desa-dark-green">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-center p-4 rounded-2xl bg-desa-red/10">
                 <p class="font-medium text-desa-red">{{ session('error') }}</p>
            </div>
        @endif

        <section id="List-Kepala-Rumah" class="flex flex-col gap-[14px]">
            <form id="Page-Search" class="flex items-center justify-between" method="GET" action="{{ route('backend.users.index') }}">
                <div class="flex flex-col gap-3 w-[370px] shrink-0">
                    <label class="relative group peer w-full valid">
                        <input type="text" name="search" placeholder="Cari User" value="{{ request('search') }}" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 pl-12 pr-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                        <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                            <img src="{{ asset('assets/backend/images/icons/user-search-secondary-green.svg') }}" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                            <img src="{{ asset('assets/backend/images/icons/user-search-black.svg') }}" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                        </div>
                    </label>
                </div>
                <div class="options flex items-center gap-4">
                    <div class="flex items-center gap-[10px]">
                        <span class="font-medium leading-5">Show</span>
                        <div class="relative">
                            <select name="per_page" id="per_page" onchange="this.form.submit()" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 pr-[52px] gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 Entries</option>
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 Entries</option>
                                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20 Entries</option>
                                <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30 Entries</option>
                                <option value="40" {{ request('per_page') == 40 ? 'selected' : '' }}>40 Entries</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 Entries</option>
                            </select>
                            <img src="{{ asset('assets/backend/images/icons/arrow-down-black.svg') }}" class="flex size-6 shrink-0 absolute transform -translate-y-1/2 top-1/2 right-6" alt="icon">
                        </div>
                    </div>
                    <button type="submit" class="flex items-center gap-1 h-14 w-fit rounded-2xl border border-desa-background bg-white py-4 px-6">
                        <img src="{{ asset('assets/backend/images/icons/filter-black.svg') }}" class="flex size-6 shrink-0" alt="icon">
                        <span class="font-medium leading-5">Filter</span>
                    </button>
                </div>
            </form>
            @forelse ($user as $users)
            <div class="card flex items-center justify-between rounded-3xl p-6 bg-white">
                <div class="flex items-center gap-3 w-[260px]">
                   @if ($users->image)
                        <div class="flex size-16 shrink-0 rounded-full overflow-hidden bg-desa-foreshadow">
                            <img src="{{ asset('storage/'. $users->image) }}" class="w-full h-full object-cover" alt="photo">
                        </div>
                   @else
                        <div class="flex items-center justify-center size-16 shrink-0 rounded-full bg-desa-foreshadow">
                            <span class="text-3xl font-semibold text-black uppercase">{{ substr($users->name, 0, 1) }}</span>
                        </div>
                   @endif
                    <div class="flex flex-col gap-[6px]">
                        <p class="font-semibold text-lg leading-[22.5px] w-[184px] truncate">{{ $users->name }}</p>
                        <p class="flex items-center gap-1">
                            <img src="{{ asset('assets/backend/images/icons/briefcase-secondary-green.svg') }}" class="flex size-[18px] shrink-0" alt="icon">
                            <span class="font-medium text-sm text-desa-secondary">{{ $users->roles->first()->name ?? 'No Role' }}</span>
                        </p>
                    </div>
                </div>
                <div class="flex flex-col gap-1 w-[180px] shrink-0">
                    <p class="flex items-center gap-1">
                        <img src="{{ asset('assets/backend/images/icons/keyboard-secondary-green.svg') }}" class="flex size-[18px] shrink-0" alt="icon">
                        <span class="font-medium text-sm text-desa-secondary">Email</span>
                    </p>
                    <p class="font-semibold leading-5">{{ $users->email }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('backend.users.edit', $users->id) }}" class="flex items-center justify-center p-3 rounded-full bg-desa-foreshadow hover:bg-yellow-100 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-500">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </a>
                    <form action="{{ route('backend.users.destroy', $users->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
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
            @empty
            <div class="card flex items-center justify-center rounded-3xl p-6 bg-white">
                <p class="font-medium text-desa-secondary">No users found.</p>
            </div>
            @endforelse
        </section>
        <nav id="Pagination">
            {{ $user->links('backend.vendor.pagination.custom') }}
        </nav>
    </div>
@endsection
