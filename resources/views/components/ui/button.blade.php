<button type="{{ $type ?? 'button' }}" class="btn {{ $class ?? 'btn-primary' }}" {{ $attributes }}>
    @if(isset($icon))
        <span class="svg-icon svg-icon-2">
            {{ $icon }}
        </span>
    @endif
    {{ $slot }}
</button>
