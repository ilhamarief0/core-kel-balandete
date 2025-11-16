@extends('backend.layouts.app')
@section('content')
            <div class="d-flex flex-column flex-column-fluid">
              <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                  <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Website Settings</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                      <li class="breadcrumb-item text-muted">
                        <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                      </li>
                      <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                      </li>
                      <li class="breadcrumb-item text-muted">Website Setting</li>
                      </ul>
                    </div>
                  </div>
                </div>
              <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title fs-3 fw-bold">Website Settings</div>
                      </div>
                    <form id="kt_modal_websiteSetting_update_form" class="form" enctype="multipart/form-data">
                      <div class="card-body p-9">
                        <div class="row mb-5">
                          <div class="col-xl-3">
                            <div class="fs-6 fw-semibold mt-2 mb-3">Project Logo</div>
                          </div>
                          <div class="col-lg-8 fv-row">
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{ asset('assets/backend/media/svg/avatars/blank.svg') }}')">
                              <div class="image-input-wrapper w-125px h-125px"></div>
                              <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="website_logo" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="website_icon_remove" />
                              </label>
                              <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                              </span>
                              <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                              </span>
                            </div>
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                          </div>
                          </div>
                        <div class="row mb-8">
                          <div class="col-xl-3">
                            <div class="fs-6 fw-semibold mt-2 mb-3">Website Name</div>
                          </div>
                          <div class="col-xl-9 fv-row">
                            <input type="text" class="form-control form-control-solid" name="website_name" id="website_name" />
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                          </div>
                        </div>
                        <div class="row mb-8">
                          <div class="col-xl-3">
                            <div class="fs-6 fw-semibold mt-2 mb-3">Website Description</div>
                          </div>
                          <div class="col-xl-9 fv-row">
                            <textarea name="website_description" id="website_description" class="form-control form-control-solid h-100px"></textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                          </div>
                        </div>
                        <div class="row mb-8">
                          <div class="col-xl-3">
                            <div class="fs-6 fw-semibold mt-2 mb-3">Website Address</div>
                          </div>
                          <div class="col-xl-9 fv-row">
                            <input type="text" class="form-control form-control-solid" name="website_address" id="website_address" />
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                          </div>
                        </div>
                        <div class="row mb-8">
                          <div class="col-xl-3">
                            <div class="fs-6 fw-semibold mt-2 mb-3">Website Phone</div>
                          </div>
                          <div class="col-xl-9 fv-row">
                            <input type="text" class="form-control form-control-solid" name="website_phone" id="website_phone" />
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                          </div>
                        </div>
                        <div class="row mb-8">
                          <div class="col-xl-3">
                            <div class="fs-6 fw-semibold mt-2 mb-3">Website Email</div>
                          </div>
                          <div class="col-xl-9 fv-row">
                            <input type="text" class="form-control form-control-solid" name="website_email" id="website_email" />
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                          </div>
                        </div>
                        <div class="row mb-8">
                          <div class="col-xl-3">
                            <div class="fs-6 fw-semibold mt-2 mb-3">Website Instagram</div>
                          </div>
                          <div class="col-xl-9 fv-row">
                            <input type="text" class="form-control form-control-solid" name="website_instagram" id="website_instagram" />
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                          </div>
                        </div>
                        <div class="row mb-8">
                          <div class="col-xl-3">
                            <div class="fs-6 fw-semibold mt-2 mb-3">Website Youtube</div>
                          </div>
                          <div class="col-xl-9 fv-row">
                            <input type="text" class="form-control form-control-solid" name="website_youtube" id="website_youtube" />
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                          </div>
                        </div>
                        <div class="row mb-8">
                          <div class="col-xl-3">
                            <div class="fs-6 fw-semibold mt-2 mb-3">Website Facebook</div>
                          </div>
                          <div class="col-xl-9 fv-row">
                            <input type="text" class="form-control form-control-solid" name="website_facebook" id="website_facebook" />
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                          </div>
                        </div>
                        <div class="row mb-8">
                          <div class="col-xl-3">
                            <div class="fs-6 fw-semibold mt-2 mb-3">Website X</div>
                          </div>
                          <div class="col-xl-9 fv-row">
                            <input type="text" class="form-control form-control-solid" name="website_x" id="website_x" />
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                          </div>
                        </div>
                    </div>
                      <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" data-kt-websiteSetting-update-action="submit">
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
            @endsection

@push('scripts')
    <script src="{{ asset('assets/backend/js/custom/apps/websiteSetting/update.js') }}"></script>
@endpush
