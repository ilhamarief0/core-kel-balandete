@if ($paginator->hasPages())
    <ul class="flex items-center gap-3">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="group">
                <button type="button" disabled class="group/arrow flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow disabled:!bg-desa-foreshadow transition-setup">
                    <img src="{{ asset('assets/backend/images/icons/disabled-arrow-pagination.svg') }}" class="flex size-6 shrink-0" alt="icon">
                </button>
            </li>
        @else
            <li class="group">
                <a href="{{ $paginator->previousPageUrl() }}" class="group/arrow flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow group-hover:bg-desa-dark-green transition-setup">
                    <img src="{{ asset('assets/backend/images/icons/arrow-left-dark-green.svg') }}" class="flex size-6 shrink-0 group-hover:hidden" alt="icon">
                    <img src="{{ asset('assets/backend/images/icons/arrow-left-foreshadow.svg') }}" class="hidden size-6 shrink-0 group-hover:flex" alt="icon">
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true">
                    <span class="flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow text-desa-dark-green font-semibold">{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="group active">
                            <a href="{{ $url }}" class="flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-dark-green transition-setup">
                                <span class="text-desa-foreshadow font-semibold transition-setup">{{ $page }}</span>
                            </a>
                        </li>
                    @else
                        <li class="group">
                            <a href="{{ $url }}" class="flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow group-hover:bg-desa-dark-green transition-setup">
                                <span class="text-desa-dark-green font-semibold group-hover:text-desa-foreshadow transition-setup">{{ $page }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="group">
                <a href="{{ $paginator->nextPageUrl() }}" class="group/arrow flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow group-hover:bg-desa-dark-green transition-setup">
                    <img src="{{ asset('assets/backend/images/icons/arrow-left-dark-green.svg') }}" class="flex size-6 shrink-0 rotate-180 group-hover:hidden" alt="icon">
                    <img src="{{ asset('assets/backend/images/icons/arrow-left-foreshadow.svg') }}" class="hidden size-6 shrink-0 rotate-180 group-hover:flex" alt="icon">
                </a>
            </li>
        @else
            <li class="group">
                <button type="button" disabled class="group/arrow flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow disabled:!bg-desa-foreshadow transition-setup">
                    <img src="{{ asset('assets/backend/images/icons/disabled-arrow-pagination.svg') }}" class="flex size-6 shrink-0 rotate-180" alt="icon">
                </button>
            </li>
        @endif
    </ul>
@endif
