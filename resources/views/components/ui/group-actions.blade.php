<div class="d-flex justify-content-end align-items-center {{ $class ?? 'd-none' }}" id="{{ $id ?? 'delete-action' }}">
    <div class="fw-bold me-5">
        <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
    </div>
    <x-ui.button type="button" class="btn-danger" id="{{ $deleteButtonId ?? 'delete-selected' }}">
        {{ $deleteButtonLabel ?? 'Delete Selected' }}
    </x-ui.button>
</div>
