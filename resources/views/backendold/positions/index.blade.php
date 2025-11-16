@extends('backend.layouts.app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <x-common.page-title
                    title="Pohon Jabatan"
                    :breadcrumbs="[
                        ['label' => 'Dashboard', 'route' => 'backend.dashboard.index'],
                        ['label' => 'Manajemen Jabatan'],
                        ['label' => 'Pohon Jabatan']
                    ]"
                />
            </div>
        </div>
        <x-common.app-content>
            <x-common.card>
                <x-slot name="header">
                    <div class="card-title">
                        <x-ui.search-input id="searchInput" placeholder="Cari Jabatan" />
                    </div>
                    <div class="card-toolbar">
                        <x-ui.toolbar-base>
                            <x-ui.add-button label="Tambah Jabatan" modal-target="#kt_modal_add_jabatan" id="add-jabatan" />
                        </x-ui.toolbar-base>
                        <x-ui.group-actions id="delete-action" />
                    </div>
                </x-slot>
                <div class="card-body">
                    {{-- Container utama Nestable untuk DIVISI --}}
                    <div class="dd" id="nestable-divisions">
                        <ol class="dd-list">
                            {{-- Loop melalui setiap divisi sebagai item Nestable --}}
                            @foreach ($divisions as $division)
                                <li class="dd-item" data-id="{{ $division->id }}" data-type="division">
                                    <div class="dd-handle">
                                        <h4 class="mb-0">{{ $division->name }}</h4>
                                    </div>
                                    {{-- Tombol aksi untuk Divisi (jika ada) --}}
                                    {{-- <div class="action-buttons-outside">
                                        <button type="button" class="btn btn-sm btn-icon btn-light-info">Edit Divisi</button>
                                    </div> --}}
                                    {{-- Nestable untuk JABATAN di dalam divisi ini --}}
                                    <ol class="dd-list">
                                        @foreach ($division->jabatans()->whereNull('parent_id')->with(['children', 'division'])->orderBy('order')->get() as $jabatan)
                                            @include('backend.positions.partials.jabatan_item', ['jabatan' => $jabatan])
                                        @endforeach
                                    </ol>
                                </li>
                            @endforeach

                            {{-- Item Nestable untuk Jabatan Tanpa Divisi --}}
                            @if (count($jabatansWithoutDivision) > 0)
                                <li class="dd-item" data-id="no-division" data-type="no-division">
                                    <div class="dd-handle">
                                        <h4 class="mb-0">Jabatan Tanpa Divisi</h4>
                                    </div>
                                    {{-- Tombol aksi untuk bagian "Tanpa Divisi" --}}
                                    {{-- <div class="action-buttons-outside"></div> --}}
                                    <ol class="dd-list">
                                        @foreach ($jabatansWithoutDivision as $jabatan)
                                            @include('backend.positions.partials.jabatan_item', ['jabatan' => $jabatan])
                                        @endforeach
                                    </ol>
                                </li>
                            @endif
                        </ol>
                    </div>
                </div>
            </x-common.card>

            {{-- Modal Add Jabatan --}}
            <x-modals.add-modal modal-id="kt_modal_add_jabatan" title="Tambah Jabatan Baru">
                <x-forms.input-group label="Nama Jabatan" name="name" required="true">
                    <x-forms.text-input name="name" id="jabatan_name_add" placeholder="Nama jabatan" required="true" />
                </x-forms.input-group>
                <x-forms.input-group label="Parent Jabatan (Opsional)" name="parent_id">
                    <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_jabatan" data-placeholder="Pilih parent jabatan" name="parent_id">
                        <option value="">Tidak ada parent</option>
                        @foreach ($allJabatans as $jabatan)
                            <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
                        @endforeach
                    </select>
                </x-forms.input-group>
                <x-forms.input-group label="Divisi (Opsional)" name="division_id">
                    <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_jabatan" data-placeholder="Pilih divisi" name="division_id" id="jabatan_division_add">
                        <option value="">Tidak ada divisi</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                        @endforeach
                    </select>
                </x-forms.input-group>
            </x-modals.add-modal>

            <x-modals.edit-modal modal-id="kt_modal_edit_jabatan" title="Edit Jabatan" edit-id-field="edit_jabatan_id">
                <x-forms.input-group label="Nama Jabatan" name="name" required="true">
                    <x-forms.text-input name="name" id="jabatan_name_edit" required="true" />
                </x-forms.input-group>
                <x-forms.input-group label="Parent Jabatan (Opsional)" name="parent_id">
                    <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_edit_jabatan" data-placeholder="Pilih parent jabatan" name="parent_id" id="jabatan_parent_edit">
                        <option value="">Tidak ada parent</option>
                        @foreach ($allJabatans as $jabatan)
                            <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
                        @endforeach
                    </select>
                </x-forms.input-group>
                <x-forms.input-group label="Divisi (Opsional)" name="division_id">
                    <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_edit_jabatan" data-placeholder="Pilih divisi" name="division_id" id="jabatan_division_edit">
                        <option value="">Tidak ada divisi</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                        @endforeach
                    </select>
                </x-forms.input-group>
            </x-modals.edit-modal>
        </x-common.app-content>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/plugins/custom/jquerynestable/jquery.nestable.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/apps/positions/tree.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/apps/positions/add.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/apps/positions/edit.js') }}"></script>
@endpush

@push('styles')
    <link href="{{ asset('assets/backend/plugins/custom/jquerynestable/jquery.nestable.css') }}" rel="stylesheet" type="text/css" />
    <style>
        /* Mengatur dd-item sebagai kontainer relatif untuk tombol aksi absolut */
        .dd-item {
            position: relative;
            /* Hapus display: flex; di sini untuk memungkinkan Nestable bekerja dengan baik */
            padding: 5px 0;
            border: none !important;
            /* Flex-wrap hanya jika Anda ingin konten di dalam dd-handle wrap */
        }

        /* Styling untuk dd-handle */
        .dd-handle {
            background: #fff;
            border: 1px solid #ddd;
            padding: 10px 15px;
            font-size: 16px;
            height: auto;
            /* flex-grow: 1; margin-right: 10px; box-sizing: border-box; */ /* Hapus properti flexbox di sini */
            display: block; /* Pastikan dd-handle adalah blok */
            padding-right: 80px; /* Beri ruang di kanan untuk tombol aksi */
            cursor: grab;
        }
        .dd-item .dd-handle:hover {
            background: #f5f5f5;
        }

        /* Styling untuk tombol aksi di luar dd-handle */
        .action-buttons-outside {
            display: flex;
            gap: 5px;
            position: absolute; /* Posisikan absolut relatif terhadap dd-item */
            right: 15px; /* Sesuaikan jarak dari kanan */
            top: 50%; /* Posisikan di tengah vertikal */
            transform: translateY(-50%); /* Penyesuaian untuk tengah vertikal */
            z-index: 10; /* Pastikan di atas dd-handle jika tumpang tindih */
        }

        /* Gaya default Nestable untuk tombol expand/collapse (yang di kiri) */
        .dd-item > button {
            margin: 0;
            height: 30px;
            width: 30px;
            position: absolute;
            left: 0px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 20;
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 1.25rem;
        }
        .dd-item > button:before {
            content: '+';
            display: block;
            position: absolute;
            width: 100%;
            text-align: center;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            font-weight: bold;
            color: #333;
        }
        .dd-collapsed > button:before {
            content: '+';
        }
        .dd-expanded > button:before {
            content: '-';
        }

        /* Penyesuaian indentasi untuk daftar anak */
        .dd-list {
            padding-left: 30px;
            width: 100%;
            margin-top: 5px;
        }
        .dd-collapsed > .dd-list {
            display: none;
        }

        /* Styling khusus untuk item divisi */
        .dd-item[data-type="division"] > .dd-handle {
            background-color: #e0f7fa;
            border-color: #b2ebf2;
            font-weight: bold;
            padding: 15px 20px;
            margin-bottom: 10px;
        }
        .dd-item[data-type="division"] > .dd-list {
            padding-left: 0; /* Hapus indentasi untuk Nestable jabatan di dalam divisi */
            width: 100%;
        }
        .dd-item[data-type="division"] {
            margin-bottom: 20px;
            border: 1px solid #b2ebf2;
            border-radius: 8px;
            padding: 10px;
            background-color: #f0fafa;
        }
        .dd-item[data-type="no-division"] > .dd-handle {
            background-color: #fff3e0;
            border-color: #ffcc80;
            font-weight: bold;
            padding: 15px 20px;
            margin-bottom: 10px;
        }
        .dd-item[data-type="no-division"] {
            margin-bottom: 20px;
            border: 1px solid #ffcc80;
            border-radius: 8px;
            padding: 10px;
            background-color: #fff8e1;
        }
    </style>
@endpush
