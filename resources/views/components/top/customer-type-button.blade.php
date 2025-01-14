@props([
    'sequence_no' => 0, // 順番
    'value' => '', // 区分
])

@php
    $sequence_no++; // index starts at 0. Need to add 1
@endphp

<label for="customer-type-input-{{ $sequence_no }}" class="custom-radio-button">
    <input type="radio" name="customer_type" value="{{ $value }}" class="hidden-radio step-radio rounded-md"
        id="customer-type-input-{{ $sequence_no }}">
    <span class="step-button customer-type-button">
        <span class="check-icon">
            <img src="{{ Vite::asset('resources/img/top/button_check.png') }}" alt="チェック" class="">
        </span>
        <span id="customer-type-span-{{ $sequence_no }}">{{ $value }}のお客様</span>
    </span>
</label>
