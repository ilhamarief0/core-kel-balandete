<li class="dd-item" data-id="{{ $jabatan->id }}">
    <div class="dd-handle">
        {{-- Konten yang bisa digeser --}}
        {{ $jabatan->name }} @if($jabatan->division) ({{ $jabatan->division->name }}) @endif
    </div>
    {{-- Tombol aksi dipindahkan keluar dari dd-handle --}}
    <div class="action-buttons-outside">
        {{-- Menambahkan onclick="event.stopPropagation()" untuk mencegah Nestable menangkap event klik --}}
        <button type="button" class="btn btn-sm btn-icon btn-light-warning me-2 edit-jabatan-btn"
            data-id="{{ $jabatan->id }}"
            data-name="{{ $jabatan->name }}"
            data-parent-id="{{ $jabatan->parent_id }}"
            data-division-id="{{ $jabatan->division_id }}"
            onclick="event.stopPropagation()">
            <i class="ki-duotone ki-pencil fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </button>
        <button type="button" class="btn btn-sm btn-icon btn-light-danger delete-jabatan-btn" data-id="{{ $jabatan->id }}" data-name="{{ $jabatan->name }}" onclick="event.stopPropagation()">
            <i class="ki-duotone ki-trash fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
                <span class="path5"></span>
            </i>
        </button>
    </div>
    @if ($jabatan->children->count() > 0)
        <ol class="dd-list">
            @foreach ($jabatan->children as $childJabatan)
                @include('backend.positions.partials.jabatan_item', ['jabatan' => $childJabatan])
            @endforeach
        </ol>
    @endif
</li>

