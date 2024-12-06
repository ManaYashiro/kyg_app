@props([
    'no' => '',
])

<div class="isConfirm mt-4 hidden">
    <!-- Car Name {{ $no }} -->
    <x-text.custom-input-label text="車名({{ $no }}台目)" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-car{{ $no }}_name" class="mb-6" />

    <!-- Car Katashiki {{ $no }} -->
    <x-text.custom-input-label text="型式({{ $no }}台目)" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-car{{ $no }}_katashiki" class="mb-6" />

    <!-- Car Number {{ $no }} -->
    <x-text.custom-input-label text="ナンバー({{ $no }}台目)" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-car{{ $no }}_number" class="mb-6" />

    <!-- Car Class {{ $no }} -->
    <x-text.custom-input-label text="車種区分({{ $no }}台目)" class="mb-2 left-border-text" />
    @foreach (\App\Enums\CarClassEnum::cases() as $carClass)
        <x-text.custom-text :text="$carClass->getLabel()" id="confirm-car{{ $no }}_class_{{ $carClass->value }}"
            class="mb-6 hidden isOption" />
    @endforeach
</div>
