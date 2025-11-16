@extends('backend.layouts.app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxxl d-flex flex-stack">
                <x-common.page-title
                    title="Dashboard Utama"
                    :breadcrumbs="[
                        ['label' => 'Dashboard', 'route' => 'backend.dashboard.index'],
                    ]"
                />
            </div>
        </div>
@endsection

@push('scripts')
@endpush
