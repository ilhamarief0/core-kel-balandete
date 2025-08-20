@extends('backend.layouts.app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <x-common.page-title
                    title="Service List"
                    :breadcrumbs="[
                        ['label' => 'Dashboard', 'route' => 'backend.dashboard.index'],
                        ['label' => 'Service Management'],
                        ['label' => 'Service List']
                    ]"
                />
            </div>
        </div>
        <x-common.app-content>
            <x-common.card>
                <x-slot name="header">
                    <div class="card-title">
                        <x-ui.search-input id="searchInput" placeholder="Search news" />
                    </div>
                    <div class="card-toolbar">
                          <a href="{{ route('backend.service.create') }}" id="add-news" class="btn btn-primary">
                              <span class="svg-icon svg-icon-2">
                                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                      <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
                                      <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
                                  </svg>
                              </span>
                              Add Service
                          </a>
                        <x-ui.group-actions id="delete-action" />
                    </div>
                </x-slot>
                <x-table.dynamic-table :headers="[
                    ['label' => 'Images', 'class' => 'min-w-15px'],
                    ['label' => 'Title', 'class' => 'min-w-85px'],
                    ['label' => 'Joined Date', 'class' => 'min-w-125px'],
                    ['label' => 'Actions', 'class' => 'text-end min-w-100px']
                ]" show-checkbox="true" class="kt_table_news">
                </x-table.dynamic-table>
            </x-common.card>

            <x-modals.edit-modal modal-id="kt_modal_edit_users" title="Edit User" edit-id-field="edit_user_id">
                <x-forms.file-input
                    name="image"
                    label="Avatar"
                    id="edit_avatar_input"
                    default-image="assets/backend/media/svg/files/blank-image.svg"
                    :current-image="null"
                />

                <x-forms.input-group label="Full Name" name="name" required="true">
                    <x-forms.text-input name="name" id="edit_name" required="true" />
                </x-forms.input-group>

                <x-forms.input-group label="Email" name="email" required="true">
                    <x-forms.email-input name="email" id="edit_email" required="true" />
                </x-forms.input-group>

                <x-forms.input-group label="Password" name="password">
                    <x-forms.password-input name="password" id="edit_password" placeholder="Leave blank to keep current" required="false" />
                </x-forms.input-group>
            </x-modals.edit-modal>
        </x-common.app-content>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/js/custom/apps/news/table.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/apps/news/delete.js') }}"></script>
@endpush
