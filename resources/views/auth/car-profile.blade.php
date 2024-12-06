@props([
    'no' => '',
])

<!-- Car Name {{ $no }} -->
<div id="container-car{{ $no }}_name" class="mt-4">
    <x-text.custom-input-label text="車名({{ $no }}台目)" class="mb-2" :option="$no !== 1 ? '任意' : '必須'" />
    <x-text-input id="car{{ $no }}_name" class="block mt-1 w-full" type="text"
        name="car{{ $no }}_name" :value="old('car' . $no . '_name')" :required="$no === 1 ? true : false" />
    <x-ajax-input-error id="error-car{{ $no }}_name" class="mt-2" />
    <x-input-error :messages="$errors->get('car' . $no . '_name')" class="mt-2" />
</div>

<!-- Car Katashiki {{ $no }} -->
<div id="container-car{{ $no }}_katashiki" class="mt-4">
    <x-text.custom-input-label text="型式({{ $no }}台目)" class="mb-2" :option="$no !== 1 ? '任意' : '任意'" />
    <x-text-input id="car{{ $no }}_katashiki" class="block mt-1 w-full" type="text"
        name="car{{ $no }}_katashiki" :value="old('car' . $no . '_katashiki')" />
    <x-ajax-input-error id="error-car{{ $no }}_katashiki" class="mt-2" />
    <x-input-error :messages="$errors->get('car' . $no . '_katashiki')" class="mt-2" />
</div>

<!-- Car Number {{ $no }} -->
<div id="container-car{{ $no }}_number" class="mt-4">
    <x-text.custom-input-label text="ナンバー({{ $no }}台目)" class="mb-2" :option="$no !== 1 ? '任意' : '必須'" />
    <x-text-input id="car{{ $no }}_number" class="block mt-1 w-full" type="text"
        name="car{{ $no }}_number" :value="old('car' . $no . '_number')" :required="$no === 1 ? true : false" />
    <x-ajax-input-error id="error-car{{ $no }}_number" class="mt-2" />
    <x-input-error :messages="$errors->get('car' . $no . '_number')" class="mt-2" />
</div>

<!-- Car Class {{ $no }} -->
<div id="container-car{{ $no }}_class" class="mt-4">
    <x-text.custom-input-label text="車種区分({{ $no }}台目)" class="mb-2" :option="$no !== 1 ? '任意' : '任意'" />
    @foreach (\App\Enums\CarClassEnum::cases() as $carClass)
        <div class="mt-4 flex items-center gap-3 mb-3">
            <x-text-input id="car{{ $no }}_class_{{ $carClass->value }}" type="radio"
                name="car{{ $no }}_class" :value="$carClass->getLabel()" :checked="old('car{{ $no }}_class') === $carClass->getLabel()" />
            <x-input-label for="car{{ $no }}_class_{{ $carClass->value }}" :value="__($carClass->getLabel())" />
        </div>
    @endforeach
    <x-ajax-input-error id="error-car{{ $no }}_class" class="mt-2" />
    <x-input-error :messages="$errors->get('car' . $no . '_class')" class="mt-2" />
</div>
