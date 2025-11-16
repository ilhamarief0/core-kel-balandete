<!--begin::Modal - Edit User-->
<div class="modal fade" id="kt_modal_edit_users" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_edit_users_header">
                <h2 class="fw-bold">Edit User</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"></i>
                </div>
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <form id="kt_modal_edit_users_form" class="form" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" id="edit_user_id">

                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" style="max-height: 500px; overflow-y: auto;">
                        <!-- Avatar -->
                        <div class="fv-row mb-7">
                            <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                            <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                                <div class="image-input-wrapper w-125px h-125px" id="edit_avatar_preview" style="background-image: url('')"></div>

                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                       data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="ki-duotone ki-pencil fs-7"></i>
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>

                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                      data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki-duotone ki-cross fs-2"></i>
                                </span>

                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                      data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="ki-duotone ki-cross fs-2"></i>
                                </span>
                            </div>
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                        </div>

                        <!-- Name -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Full Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control form-control-solid" />
                        </div>

                        <!-- Email -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                            <input type="email" name="email" id="edit_email" class="form-control form-control-solid" />
                        </div>

                        <!-- Password -->
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Password (leave blank to keep current)</label>
                            <input type="password" name="password" class="form-control form-control-solid" placeholder="******" />
                        </div>

                        <!-- Role -->
                        <div class="mb-5">
                            <label class="required fw-semibold fs-6 mb-5">Role</label>
                            <div class="d-flex flex-column gap-3" id="edit_roles_wrapper">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input me-3" name="user_role" type="radio" value="Administrator" id="edit_role_admin" />
                                    <label class="form-check-label" for="edit_role_admin">
                                        <div class="fw-bold text-gray-800">Administrator</div>
                                    </label>
                                </div>
                                 <div class='separator separator-dashed my-5'></div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input me-3" name="user_role" type="radio" value="Viewer" id="edit_role_viewer" />
                                    <label class="form-check-label" for="edit_role_viewer">
                                        <div class="fw-bold text-gray-800">Viewer</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                         <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"
                            data-kt-customer-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
            <!--end::Modal body-->
        </div>
    </div>
</div>
<!--end::Modal - Edit User-->
