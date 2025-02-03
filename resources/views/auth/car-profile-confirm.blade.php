@props([
    'sequence_no' => '',
])
<div class="isConfirm mt-4 hidden">
    <!-- Car Name {{ $sequence_no }} -->
    <x-text.custom-input-label text="車名({{ $sequence_no }}台目)" class="mb-2 left-border-text" />
    {{-- 例：confirm-car_name_1 --}}
    <x-text.custom-text :text="''" id="confirm-car_name_{{ $sequence_no }}" class="mb-6" />

    <!-- Car Katashiki {{ $sequence_no }} -->
    <x-text.custom-input-label text="型式({{ $sequence_no }}台目)" class="mb-2 left-border-text" />
    {{-- 例：confirm-car_katashiki_1 --}}
    <x-text.custom-text :text="''" id="confirm-car_katashiki_{{ $sequence_no }}" class="mb-6" />

    <!-- Car Number {{ $sequence_no }} -->
    <x-text.custom-input-label text="ナンバー({{ $sequence_no }}台目)" class="mb-2 left-border-text" />
    {{-- 例：confirm-transport_branch_1 --}}
    <div class="flex space-x-4">
    <x-text.custom-text :text="''" id="confirm-transport_branch_{{ $sequence_no }}" class="mb-6" />
    <x-text.custom-text :text="''" id="confirm-classification_no_{{ $sequence_no }}" class="mb-6" />
    <x-text.custom-text :text="''" id="confirm-kana_{{ $sequence_no }}" class="mb-6" />
    <x-text.custom-text :text="''" id="confirm-serial_no_{{ $sequence_no }}" class="mb-6" />
    </div>
    <!-- Car Class {{ $sequence_no }} -->
    <x-text.custom-input-label text="車種区分({{ $sequence_no }}台目)" class="mb-2 left-border-text" />

    @php
        $car_class_list = [];
    @endphp
    @foreach (\App\Enums\CarClassEnum::cases() as $carClass)
        @php
            array_push($car_class_list, [
                'id' => $carClass->value,
                'name' => $carClass->getLabel(),
            ]);
        @endphp
    @endforeach
    {{-- 例：confirm-car_class-list_1 --}}
    <input type="hidden" id="confirm-car_class-list_{{ $sequence_no }}"
        data-list="{{ json_encode($car_class_list, JSON_PRETTY_PRINT) }}">
    {{-- 例：confirm-car_class_1 --}}
    <x-text.custom-text :text="''" id="confirm-car_class_{{ $sequence_no }}"
        class="mb-6 w-full overflow-hidden" textClass="block break-words" />
</div>
