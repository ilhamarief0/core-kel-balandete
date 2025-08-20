@extends('backend.layouts.app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <x-common.page-title
                    title="Banner List"
                    :breadcrumbs="[
                        ['label' => 'Dashboard', 'route' => 'backend.dashboard.index'],
                        ['label' => 'Website Setting'],
                        ['label' => 'Banner']
                    ]"
                />
            </div>
        </div>
        <x-common.app-content>
            <x-common.card>
                <x-slot name="header">
                    <div class="card-title">
                        <x-ui.search-input id="searchInput" placeholder="Search banner" />
                    </div>
                    <div class="card-toolbar">
                        <x-ui.toolbar-base>
                            <x-ui.add-button label="Add Banner" modal-target="#kt_modal_add_banner" id="add-banner" />
                        </x-ui.toolbar-base>
                        <x-ui.group-actions id="delete-action" />
                    </div>
                </x-slot>
                <x-table.dynamic-table :headers="[
                    ['label' => 'Image', 'class' => 'min-w-125px'],
                    ['label' => 'Title', 'class' => 'min-w-125px'],
                    ['label' => 'Is Active', 'class' => 'min-w-125px'],
                    ['label' => 'Joined Date', 'class' => 'min-w-125px'],
                    ['label' => 'Actions', 'class' => 'text-end min-w-100px']
                ]" show-checkbox="true" class="kt_table_banner">
                </x-table.dynamic-table>
            </x-common.card>

            <x-modals.add-modal modal-id="kt_modal_add_banner" title="Add Banner">
                <x-forms.file-input name="image" label="Image" default-image="assets/backend/media/avatars/blank.svg" :current-image="null"  box-width="550px" box-height="200px"/>

                <x-forms.input-group label="Banner Title" name="title" required="true">
                    <x-forms.text-input name="title" id="nameadd" placeholder="Banner Title" required="true" />
                </x-forms.input-group>

                <div class="mb-5">
                    <label class="required fw-semibold fs-6 mb-5">Is Active</label>
                    <div class="d-flex flex-column gap-3" id="edit_roles_wrapper">
                        <x-forms.radio-group name="is_active" value="yes" id="edit_role_admin" label="Yes" checked="true" />
                        <div class='separator separator-dashed my-5'></div>
                        <x-forms.radio-group name="is_active" value="no" id="edit_role_viewer" label="No" />
                    </div>
                </div>

            </x-modals.add-modal>

<x-modals.edit-modal modal-id="kt_modal_edit_banner" title="Edit Banner" edit-id-field="edit_banner_id">
    <x-forms.file-input
        name="image"
        label="Image"
        id="edit_avatar_input"
        default-image="assets/backend/media/svg/files/blank-image.svg"
        :current-image="null"
        box-width="550px" box-height="200px"
    />

    <x-forms.input-group label="Banner Title" name="title" required="true">
        <x-forms.text-input name="title" id="edit_title" required="true" />
    </x-forms.input-group>

    <div class="mb-5">
        <label class="required fw-semibold fs-6 mb-5">Is Active</label>
        <div class="d-flex flex-column gap-3" id="edit_banner_wrapper">
            <x-forms.radio-group name="is_active" value="yes" id="edit_isactive_yes" label="Yes" />
            <div class='separator separator-dashed my-5'></div>
            <x-forms.radio-group name="is_active" value="no" id="edit_is_active_no" label="No" />
        </div>
    </div>
</x-modals.edit-modal>
        </x-common.app-content>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/js/custom/apps/banner/table.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/apps/banner/add.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/apps/banner/edit.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/apps/banner/delete.js') }}"></script>
@endpush
