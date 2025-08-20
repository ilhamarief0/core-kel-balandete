@extends('backend.layouts.app')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <x-common.page-title
                    title="About List"
                    :breadcrumbs="[
                        ['label' => 'Dashboard', 'route' => 'backend.dashboard.index'],
                        ['label' => 'About Management'],
                        ['label' => 'About List']
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
                </x-slot>
                <x-table.dynamic-table :headers="[
                    ['label' => 'view', 'class' => 'min-w-85px'],
                    ['label' => 'Images', 'class' => 'min-w-15px'],
                    ['label' => 'Title', 'class' => 'min-w-85px'],
                    ['label' => 'Joined Date', 'class' => 'min-w-125px'],
                    ['label' => 'Actions', 'class' => 'text-end min-w-100px']
                ]" class="kt_table_about">
                </x-table.dynamic-table>
            </x-common.card>
        </x-common.app-content>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/js/custom/apps/about/table.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/apps/news/delete.js') }}"></script>
@endpush
