@extends('backend.layouts.app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <x-common.page-title
                    title="Users List"
                    :breadcrumbs="[
                        ['label' => 'Dashboard', 'route' => 'backend.dashboard.index'],
                        ['label' => 'User Management'],
                        ['label' => 'Users']
                    ]"
                />
            </div>
        </div>
        <x-common.app-content>
            <x-common.card>
                <x-slot name="header">
                    <div class="card-title">
                        <x-ui.search-input id="searchInput" placeholder="Search user" />
                    </div>
                    <div class="card-toolbar">
                        <x-ui.toolbar-base>
                            <x-ui.add-button label="Add User" modal-target="#kt_modal_add_users" id="add-user" />
                        </x-ui.toolbar-base>
                        <x-ui.group-actions id="delete-action" />
                    </div>
                </x-slot>
                <x-table.dynamic-table :headers="[
                    ['label' => 'Profile', 'class' => 'min-w-125px'],
                    ['label' => 'Role', 'class' => 'min-w-125px'],
                    ['label' => 'Joined Date', 'class' => 'min-w-125px'],
                    ['label' => 'Actions', 'class' => 'text-end min-w-100px']
                ]" show-checkbox="true" class="kt_table_users">
                </x-table.dynamic-table>
            </x-common.card>

            <x-modals.add-modal modal-id="kt_modal_add_users" title="Add User">
                <x-forms.file-input name="image" label="Avatar" default-image="assets/backend/media/avatars/blank.svg" :current-image="null"/>

                <x-forms.input-group label="Full Name" name="name" required="true">
                    <x-forms.text-input name="name" id="nameadd" placeholder="Full name" required="true" />
                </x-forms.input-group>

                <x-forms.input-group label="Email" name="email" required="true">
                    <x-forms.email-input name="email" placeholder="example@domain.com" required="true" />
                </x-forms.input-group>

                <x-forms.input-group label="Password" name="password" required="true">
                    <x-forms.password-input name="password" required="true" />
                </x-forms.input-group>

                <div class="mb-5">
                    <label class="required fw-semibold fs-6 mb-5">Role</label>
                    @foreach ($roles as $rolesItem)
                    <x-forms.radio-group name="user_role" value="{{ $rolesItem->name }}" id="kt_modal_update_role_option_0" label="{{ $rolesItem->name }}" checked="true" />
                    <div class='separator separator-dashed my-5'></div>
                    @endforeach
                </div>
            </x-modals.add-modal>

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

                <div class="mb-5">
                    <label class="required fw-semibold fs-6 mb-5">Role</label>
                    <div class="d-flex flex-column gap-3" id="edit_roles_wrapper">
                        <x-forms.radio-group name="user_role" value="Administrator" id="edit_role_admin" label="Administrator" />
                        <div class='separator separator-dashed my-5'></div>
                        <x-forms.radio-group name="user_role" value="Viewer" id="edit_role_viewer" label="Viewer" />
                    </div>
                </div>
            </x-modals.edit-modal>
        </x-common.app-content>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/js/custom/apps/user-management/users/table.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/apps/user-management/users/add.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/apps/user-management/users/edit.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/apps/user-management/users/delete.js') }}"></script>
@endpush
