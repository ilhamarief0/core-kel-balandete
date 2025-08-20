<div class="fv-row mb-7">
    <label class="d-block fw-semibold fs-6 mb-5">{{ $label }}</label>
    <style>.image-input-placeholder { background-image: url('assets/backend/media/svg/files/blank-image.svg'); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url('assets/backend/media/svg/files/blank-image-dark.svg'); }</style>
    <div class="image-input image-input-outline image-input-placeholder {{ $wrapperClass ?? '' }}" data-kt-image-input="true"
        id="{{ $id ?? '' }}"
        style="background-image: url('{{ $defaultImage ?? asset('assets/backend/media/avatars/blank.svg') }}'); width: {{ $boxWidth ?? '125px' }}; height: {{ $boxHeight ?? '125px' }};">
        <div class="image-input-wrapper {{ $previewClass ?? '' }}"
            style="background-image: url('{{ $currentImage ? asset('storage/' . $currentImage) : ($defaultImage ?? asset('assets/backend/media/avatars/blank.svg')) }}'); {{ $previewStyle ?? '' }} width: {{ $boxWidth ?? '125px' }}; height: {{ $boxHeight ?? '125px' }};">
        </div>

        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change {{ strtolower($label) }}">
            <i class="ki-duotone ki-pencil fs-7">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
            <input type="file" name="{{ $name }}" accept=".png, .jpg, .jpeg" />
            <input type="hidden" name="{{ $name }}_remove" />
        </label>
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel {{ strtolower($label) }}">
            <i class="ki-duotone ki-cross fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </span>
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove {{ strtolower($label) }}">
            <i class="ki-duotone ki-cross fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </span>
    </div>
    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
    @error($name)
        <div class="fv-plugins-message-container invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
