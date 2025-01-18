@props([
    'sequence_no' => 0, // 順番
    'label' => '',
    'value' => '',
    'selected_has_tire_storage' => '',
])

@php
    $sequence_no++; // index starts at 0. Need to add 1
@endphp

<label for="tire-storage-input-{{ $sequence_no }}" class="custom-radio-button">
    <input type="radio" name="has_tire_storage" value="{{ $value }}" class="hidden-radio step-radio rounded-md"
        id="tire-storage-input-{{ $sequence_no }}" disabled {{ $selected_has_tire_storage == $value ? 'checked' : '' }}>
    <span class="step-button tire-storage-button">
        <span class="check-icon">
            <img src="{{ Vite::asset('resources/img/top/button_check.png') }}" alt="チェック" class="">
        </span>
        <span id="tire-storage-span-{{ $sequence_no }}">{{ $label }}</span>
    </span>
</label>
