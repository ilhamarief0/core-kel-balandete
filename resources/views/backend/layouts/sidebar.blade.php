<aside id="Sidebar" class="relative flex w-[280px] shrink-0 min-h-screen bg-white border-r border-desa-foreshadow overflow-hidden">
                <div class="fixed top-0 h-full w-[280px] flex shrink-0 flex-1 z-20 bg-white">
                    <div class="flex flex-col h-full w-full gap-6 pt-[30px] px-6">
                        <div class="flex items-center justify-between">
                            <img src="{{ asset('assets/backend/images/logos/logobalandeteku.png') }}" class="flex h-[30px] shrink-0" alt="logo">
                            <button class="flex size-11 items-center justify-center rounded-2xl border border-desa-background hover:border-desa-secondary transition-setup">
                                <img src="{{ asset('assets/backend/images/icons/menu-secondary-green.svg') }}" class="size-6" alt="icon">
                            </button>
                        </div>
                        <div class="flex flex-col flex-1 gap-6 overflow-y-scroll hide-scrollbar">
                            <nav class="flex flex-col gap-2 pb-12">
                                <p class="font-medium text-sm text-desa-secondary">Main Menu</p>
                                <ul>
                                    <li class="group {{ Route::is('backend.dashboard.index') ? 'active' : '' }}">
                                        <a href="{{ route('backend.dashboard.index') }}" class=" flex items-center h-14 gap-2 rounded-2xl p-4 group-hover:bg-desa-foreshadow group-[.active]:bg-desa-foreshadow transition-setup">
                                            <div class="relative flex size-6 shrink-0">
                                                <img src="{{ asset('assets/backend/images/icons/chart-square-dark-green.svg') }}" class="absolute flex size-6 shrink-0 opacity-0 group-hover:opacity-100 group-[.active]:opacity-100 transition-setup" alt="icon">
                                                <img src="{{ asset('assets/backend/images/icons/chart-square-secondary-green.svg') }}" class="absolute flex size-6 shrink-0 opacity-100 group-hover:opacity-0 group-[.active]:opacity-0 transition-setup" alt="icon">
                                            </div>
                                            <span class="text-left leading-5 text-desa-secondary flex flex-1 group-hover:text-desa-dark-green group-[.active]:text-desa-dark-green group-[.active]:font-medium transition-setup">
                                                Dashboard
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="group {{ Route::is('backend.users.*') ? 'active' : '' }}">
                                        <a href="{{ route('backend.users.index') }}" class=" flex items-center h-14 gap-2 rounded-2xl p-4 group-hover:bg-desa-foreshadow group-[.active]:bg-desa-foreshadow transition-setup">
                                            <div class="relative flex size-6 shrink-0">
                                                <img src="{{ asset('assets/backend/images/icons/profile-dark-green.svg') }}" class="absolute flex size-6 shrink-0 opacity-0 group-hover:opacity-100 group-[.active]:opacity-100 transition-setup" alt="icon">
                                                <img src="{{ asset('assets/backend/images/icons/profile-secondary-green.svg') }}" class="absolute flex size-6 shrink-0 opacity-100 group-hover:opacity-0 group-[.active]:opacity-0 transition-setup" alt="icon">
                                            </div>
                                            <span class="text-left leading-5 text-desa-secondary flex flex-1 group-hover:text-desa-dark-green group-[.active]:text-desa-dark-green group-[.active]:font-medium transition-setup">
                                                Users
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="accordion group/accordion flex flex-col gap-1 w-full">
                                    <button data-expand="Bantuan-Sosial-Content" class="group flex w-full shrink-0 items-center h-14 gap-2 rounded-2xl p-4 active">
                                        <div class="relative flex size-6 shrink-0">
                                            <img src="{{ asset('assets/backend/images/icons/bag-2-dark-green.svg') }}" class="absolute flex size-6 shrink-0 opacity-0 group-[.active]:opacity-100 transition-setup" alt="icon">
                                            <img src="{{ asset('assets/backend/images/icons/bag-2-secondary-green.svg') }}" class="absolute flex size-6 shrink-0 opacity-100 group-[.active]:opacity-0 transition-setup" alt="icon">
                                        </div>
                                        <span class="text-left leading-5 text-desa-secondary flex flex-1 group-[.active]:text-desa-dark-green transition-setup">
                                            Media Kelurahan
                                        </span>
                                        <div class="relative flex size-6 shrink-0">
                                            <img src="{{ asset('assets/backend/images/icons/arrow-circle-dark-green-up.svg') }}" class="absolute flex size-6 shrink-0 opacity-0 group-[.active]:opacity-100 transition-setup" alt="icon">
                                            <img src="{{ asset('assets/backend/images/icons/arrow-circle-secondary-green-down.svg') }}" class="absolute flex size-6 shrink-0 opacity-100 group-[.active]:opacity-0 transition-setup" alt="icon">
                                        </div>
                                    </button>
                                    <ul id="Bantuan-Sosial-Content" class="flex flex-col flex-1r pl-[28px]">
                                        <li class="flex items-center h-[52px] shrink-0 border-l border-desa-background last-of-type:border-0">
                                            <div class="flex h-full w-[26px] shrink-0 overflow-hidden">
                                                <img src="{{ asset('assets/backend/images/icons/accodion-line.svg') }}" class="h-full object-contain object-left-top" alt="ornament">
                                            </div>
                                            <a href="{{ route('backend.news.index') }}" class="group {{ Route::is('backend.news.*') ? 'active' : '' }} flex flex-1 items-center h-[52px] gap-2 rounded-2xl p-4 hover:bg-desa-foreshadow [&.active]:bg-desa-foreshadow transition-setup">
                                                <span class="text-left leading-5 text-desa-secondary group-hover:text-desa-dark-green group-[.active]:text-desa-dark-green group-[.active]:font-medium transition-setup">
                                                   Berita
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <ul>
                                    <li class="group {{ Route::is('backend.websiteSetting.*') ? 'active' : '' }}">
                                        <a href="{{ route('backend.websiteSetting.index') }}" class=" flex items-center h-14 gap-2 rounded-2xl p-4 group-hover:bg-desa-foreshadow group-[.active]:bg-desa-foreshadow transition-setup">
                                            <div class="relative flex size-6 shrink-0">
                                                <img src="{{ asset('assets/backend/images/icons/building-4-dark-green.svg') }}" class="absolute flex size-6 shrink-0 opacity-0 group-hover:opacity-100 group-[.active]:opacity-100 transition-setup" alt="icon">
                                                <img src="{{ asset('assets/backend/images/icons/building-4-secondary-green.svg') }}" class="absolute flex size-6 shrink-0 opacity-100 group-hover:opacity-0 group-[.active]:opacity-0 transition-setup" alt="icon">
                                            </div>
                                            <span class="text-left leading-5 text-desa-secondary flex flex-1 group-hover:text-desa-dark-green group-[.active]:text-desa-dark-green group-[.active]:font-medium transition-setup">
                                                Profile Desa
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </aside>
