<div class="d-flex {{ $direction ?? 'fv-row' }}">
    <div class="form-check form-check-custom form-check-solid">
        <input class="form-check-input me-3" name="{{ $name }}" type="radio" value="{{ $value }}" id="{{ $id }}" {{ ($checked ?? false) ? 'checked' : '' }} />
        <label class="form-check-label" for="{{ $id }}">
            <div class="fw-bold text-gray-800">{{ $label }}</div>
            @if(isset($description))
                <div class="fs-7 text-muted">{{ $description }}</div>
            @endif
        </label>
    </div>
</div>
