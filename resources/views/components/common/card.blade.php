<div class="card">
    @if(isset($header))
        <div class="card-header border-0 pt-6">
            {{ $header }}
        </div>
    @endif
    <div class="card-body py-4">
        {{ $slot }}
    </div>
</div>
