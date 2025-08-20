<x-ui.button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="{{ $modalTarget }}" id="{{ $id ?? 'add-button' }}">
    <x-slot:icon>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
        </svg>
    </x-slot:icon>
    {{ $label ?? 'Add New' }}
</x-ui.button>
