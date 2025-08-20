<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
    @foreach ($items as $item)
        <li class="breadcrumb-item {{ $loop->last ? 'text-muted' : 'text-muted text-hover-primary' }}">
            @if (!$loop->last)
                {{-- Gunakan helper route() jika 'route' tersedia, jika tidak fallback ke 'url' --}}
                <a href="{{ isset($item['route']) ? route($item['route']) : ($item['url'] ?? '#') }}" class="text-muted text-hover-primary">{{ $item['label'] }}</a>
            @else
                {{ $item['label'] }}
            @endif
        </li>
        @if (!$loop->last)
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
        @endif
    @endforeach
</ul>
