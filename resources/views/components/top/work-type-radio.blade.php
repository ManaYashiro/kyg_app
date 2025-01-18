@props([
    'sequence_no' => 0, // 順番
    'value' => '', // 作業種別の値
    'type' => '', // 作業種別の値
    'selected_work_type' => '',
])

@php
    $sequence_no++; // index starts at 0. Need to add 1
@endphp

<div class="hidden work-type-item" data-type="{{ $type }}">
    <div class="grid grid-cols-4 grid-rows-1 gap-4 items-center text-xs font-bold">
        <label for="work-type-input-{{ $sequence_no }}"
            class="col-span-3 flex gap-3 items-center justify-start cursor-pointer">
            <input type="radio" name="work_type" value="{{ $value }}" class="hidden-radio step-radio"
                id="work-type-input-{{ $sequence_no }}" {{ $selected_work_type == $value ? 'checked' : '' }}>
            <div class="step-border border border-red-700 px-1 py-2">
                <span class="check-icon input-type-check">
                    <img src="{{ Vite::asset('resources/img/top/button_check.png') }}" alt="チェック" class="w-4">
                </span>
            </div>
            <span class="text-clip">{{ $value }}</span>
        </label>
        <div class="col-start-4 text-red-600 font-bold px-2 text-right inline-block">
        </div>
    </div>
    <hr class="my-2 border-1 border-red-600" />
</div>
