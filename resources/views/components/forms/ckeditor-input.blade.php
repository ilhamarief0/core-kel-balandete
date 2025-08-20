<div class="fv-row {{ $class ?? '' }}">
    <label class="{{ ($required ?? false) ? 'required ' : '' }}fw-semibold fs-6 mb-2">{{ $label }}</label>
    <textarea name="{{ $name }}" id="{{ $id ?? $name }}" class="form-control form-control-solid {{ $textareaClass ?? '' }}" {{ ($required ?? false) ? 'required' : '' }}>{{ $value ?? '' }}</textarea>
    @error($name)
        <div class="fv-plugins-message-container invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Only initialize if the element exists
        const editorElement = document.querySelector('#{{ $id ?? $name }}');
        if (editorElement) {
            ClassicEditor
                .create(editorElement)
                .then(editor => {
                    // Editor initialized
                    // console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
</script>
@endpush
