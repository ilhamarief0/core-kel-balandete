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
                  <form id="kt_modal_edit_news_form" class="form" enctype="multipart/form-data"">
                        @csrf
                        @method('PUT')
                        <div class="card-body p-9">

                            <div class="row mb-8">
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-semibold mt-2 mb-3">Contact Name</div>
                                </div>
                                <div class="col-xl-9 fv-row">
                                    <input type="text" class="form-control form-control-solid" name="name" value="{{ old('name', $contactusEdit->name) }}" id="name" />
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row mb-8">
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-semibold mt-2 mb-3">Contact Email</div>
                                </div>
                                <div class="col-xl-9 fv-row">
                                    <input type="email" class="form-control form-control-solid" name="email" value="{{ old('email', $contactusEdit->email) }}" id="email" />
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row mb-8">
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-semibold mt-2 mb-3">Contact</div>
                                </div>
                                <div class="col-xl-9 fv-row">
                                    <input type="text" class="form-control form-control-solid" name="contact" value="{{ old('contact', $contactusEdit->contact) }}" id="contact" />
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row mb-8">
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-semibold mt-2 mb-3">Message Content</div>
                                </div>
                                <div class="col-xl-9 fv-row">
                                    <textarea name="message" class="form-control form-control-solid h-400px">
                                        {{ old('message', $contactusEdit->message) }}
                                    </textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


