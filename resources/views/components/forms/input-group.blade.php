<div class="fv-row mb-7 {{ $class ?? '' }}">
    <label class="{{ ($required ?? false) ? 'required ' : '' }}fw-semibold fs-6 mb-2">{{ $label }}</label>
    {{ $slot }}
    @error($name ?? '') {{-- Menggunakan name dari input di dalam slot jika ada --}}
        <div class="fv-plugins-message-container invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
