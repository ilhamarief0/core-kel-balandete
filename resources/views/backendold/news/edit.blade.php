@extends('backend.layouts.app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit News</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ url('/') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Edit News</li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxxl">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title fs-3 fw-bold">Edit News</div>
                    </div>
                  <form id="kt_modal_edit_news_form" class="form" enctype="multipart/form-data" data-edit-url="{{ route('backend.news.update', Crypt::encryptString($newsEdit->id)) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body p-9">
                            <div class="row mb-10">
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-semibold mt-2 mb-3">News Image</div>
                                </div>
                                <div class="col-lg-9 fv-row">
                                    <div
                                        class="image-input image-input-outline w-100"
                                        data-kt-image-input="true"
                                        style="background-image: url('{{ asset('assets/backend/media/svg/avatars/blank.svg') }}');"
                                    >
                                        <div
                                            class="image-input-wrapper"
                                            style="width: 100%; height: 400px; background-size: cover; background-position: center; background-image: url('{{ asset('storage/'. $newsEdit->image) }}');"
                                        ></div>

                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                            data-kt-image-input-action="change"
                                            data-bs-toggle="tooltip"
                                            title="Change image"
                                        >
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg" /> <input type="hidden" name="news_image_remove" /> </label>

                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                            data-kt-image-input-action="cancel"
                                            data-bs-toggle="tooltip"
                                            title="Cancel image"
                                        >
                                            <i class="bi bi-x fs-2"></i>
                                        </span>

                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                            data-kt-image-input-action="remove"
                                            data-bs-toggle="tooltip"
                                            title="Remove image"
                                        >
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                    </div>

                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="row mb-8">
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-semibold mt-2 mb-3">News Title</div>
                                </div>
                                <div class="col-xl-9 fv-row">
                                    <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title', $newsEdit->title) }}" id="title" />
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row mb-8">
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-semibold mt-2 mb-3">News Content</div>
                                </div>
                                <div class="col-xl-9 fv-row">
                                    <textarea name="content" id="kt_docs_ckeditor_classic" class="form-control form-control-solid h-400px">
                                        {{ old('content', $newsEdit->content) }}
                                    </textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary" data-kt-news-add-action="submit">
                                <span class="indicator-label">Update</span>
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

@push('styles')
    <link href="{{ asset('assets/backend/css/ckCustom.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('assets/backend/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
<script src="{{ asset('assets/backend/js/custom/apps/news/edit.js') }}"></script>
@endpush
