@extends('backend.layouts.app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <x-common.page-title
                    title="Team List"
                    :breadcrumbs="[
                        ['label' => 'Dashboard', 'route' => 'backend.dashboard.index'],
                        ['label' => 'About Management'],
                        ['label' => 'Team']
                    ]"
                />
            </div>
        </div>
        <x-common.app-content>
            <x-common.card>
                <x-slot name="header">
                    <div class="card-title">
                        <x-ui.search-input id="searchInput" placeholder="Search team" />
                    </div>
                    <div class="card-toolbar">
                        <x-ui.toolbar-base>
                            <x-ui.add-button label="Add Team" modal-target="#kt_modal_add_team" id="add-team" />
                        </x-ui.toolbar-base>
                        <x-ui.group-actions id="delete-action" />
                    </div>
                </x-slot>
                <x-table.dynamic-table :headers="[
                    ['label' => 'Image', 'class' => 'min-w-125px'],
                    ['label' => 'Position', 'class' => 'min-w-125px'],
                    ['label' => 'Joined Date', 'class' => 'min-w-125px'],
                    ['label' => 'Actions', 'class' => 'text-end min-w-100px']
                ]" show-checkbox="true" class="kt_table_team">
                </x-table.dynamic-table>
            </x-common.card>

            <x-modals.add-modal modal-id="kt_modal_add_team" title="Add Team">
                <x-forms.file-input name="image" label="Avatar" default-image="assets/backend/media/avatars/blank.svg" :current-image="null"/>

                <x-forms.input-group label="Full Name" name="name" required="true">
                    <x-forms.text-input name="name" id="nameadd" placeholder="Full name" required="true" />
                </x-forms.input-group>

                <x-forms.input-group label="Instagram" name="instagram" required="true">
                    <x-forms.text-input name="instagram" placeholder="Instagram" required="false"/>
                </x-forms.input-group>

                <x-forms.input-group label="Facebook" name="facebook" required="true">
                    <x-forms.text-input name="facebook" placeholder="Facebook" required="false"/>
                </x-forms.input-group>

                <x-forms.input-group label="X" name="x" required="true">
                    <x-forms.text-input name="x" placeholder="X" required="false"/>
                </x-forms.input-group>

                <div class="mb-5">
                    <label class="required fw-semibold fs-6 mb-5">Position</label>
                    @foreach ($position as $positions)
                    <x-forms.radio-group name="id_position" value="{{ $positions->id }}" id="kt_modal_update_role_option_0" label="{{ $positions->name }}" checked="true" />
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
    <script src="{{ asset('assets/backend/js/custom/apps/team/table.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/apps/team/add.js') }}"></script>
@endpush
