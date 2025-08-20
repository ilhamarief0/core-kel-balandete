<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="{{ $modalId }}_header">
                <h2 class="fw-bold">{{ $title }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"></i>
                </div>
            </div>
            <div class="modal-body px-5 my-7">
                <form id="{{ $formId ?? $modalId . '_form' }}" class="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Tambahkan method PUT untuk update --}}
                    <input type="hidden" name="id" id="{{ $editIdField ?? 'edit_id' }}">

                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" style="max-height: 500px; overflow-y: auto;">
                        {{ $slot }}
                    </div>
                    <div class="text-center pt-10">
                           <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"
                                data-kt-customer-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    </form>
            </div>
            </div>
    </div>
</div>
