<table class="table align-middle table-row-dashed fs-6 gy-5 {{ $class ?? '' }}">
    <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
            @if(isset($showCheckbox) && $showCheckbox)
            <th class="w-10px pe-2"></th>
            @endif
            @foreach ($headers as $header)
                <th class="{{ $header['class'] ?? '' }}">{{ $header['label'] }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-semibold">
        {{ $slot }}
    </tbody>
</table>
