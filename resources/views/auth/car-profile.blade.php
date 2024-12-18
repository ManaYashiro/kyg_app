@props([
    'sequence_no' => 0,
    'userVehicle' => null,
])

@php
    $open = $sequence_no . '台目：開く';
    $close = $sequence_no . '台目：閉る';
@endphp

<button type="button"
    class="max-w-[100px]  bg-red-300 hover:bg-red-400 text-white text-sm font-sequence_normal p-2 rounded"
    @click="car_{{ $sequence_no }} = !car_{{ $sequence_no }}"
    x-text="car_{{ $sequence_no }} === true ? '{{ $open }}' : '{{ $close }}'"></button>
<div class="relative overflow-hidden duration-700" x-ref="containerCar_{{ $sequence_no }}"
    x-bind:class="{ 'max-h-0': !car_{{ $sequence_no }} }"
    x-bind:style="car_{{ $sequence_no }} == true ? 'max-height: ' + height + 'px' : ''" x-cloak
    x-transition:enter="transition-all ease-in duration-300" x-transition:enter-start="opacity-0 max-h-0"
    x-transition:enter-end="opacity-100 max-h-screen" x-transition:leave="transition-all ease-out duration-300"
    x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0">


    <!-- Car Sequence {{ $sequence_no }} -->
    @php
        $key = 'sequence_no_' . $sequence_no;
        $errorKey = 'sequence_no_' . ($sequence_no - 1);
        $name = 'sequence_no[]';
    @endphp
    <x-text-input id="{{ $key }}" class="block mt-1 w-full" type="hidden" name="{{ $name }}"
        :value="old($key) ?? ($userVehicle ? $userVehicle->sequence_no : null)" :required="$sequence_no === 1 ? true : false" />

    <!-- Car Name {{ $sequence_no }} -->
    @php
        $key = 'car_name_' . $sequence_no;
        $errorKey = 'car_name_' . ($sequence_no - 1);
        $name = 'car_name[]';
    @endphp
    <div id="container-{{ $key }}" class="mt-4">
        <x-text.custom-input-label text="車名({{ $sequence_no }}台目)" class="mb-2" :option="$sequence_no !== 1 ? '任意' : '必須'" />
        <x-text-input id="{{ $key }}" class="block mt-1 w-full" type="text" name="{{ $name }}"
            :value="old($key) ?? ($userVehicle ? $userVehicle->car_name : null)" :required="$sequence_no === 1 ? true : false" />
        <x-ajax-input-error id="error-{{ $errorKey }}" class="mt-2" />
        <x-input-error :messages="$errors->get($key)" class="mt-2" />
    </div>

    <!-- Car Katashiki {{ $sequence_no }} -->
    @php
        $key = 'car_katashiki_' . $sequence_no;
        $errorKey = 'car_katashiki_' . ($sequence_no - 1);
        $name = 'car_katashiki[]';
    @endphp
    <div id="container-{{ $key }}" class="mt-4">
        <x-text.custom-input-label text="型式({{ $sequence_no }}台目)" class="mb-2" :option="$sequence_no !== 1 ? '任意' : '任意'" />
        <x-text-input id="{{ $key }}" class="block mt-1 w-full" type="text" name="{{ $name }}"
            :value="old($key) ?? ($userVehicle ? $userVehicle->car_katashiki : null)" />
        <x-ajax-input-error id="error-{{ $errorKey }}" class="mt-2" />
        <x-input-error :messages="$errors->get($key)" class="mt-2" />
    </div>

    <!-- Car Number {{ $sequence_no }} -->
    @php
        $key = 'car_number_' . $sequence_no;
        $errorKey = 'car_number_' . ($sequence_no - 1);
        $name = 'car_number[]';
    @endphp
    <div id="container-{{ $key }}" class="mt-4">
        <x-text.custom-input-label text="ナンバー({{ $sequence_no }}台目)" class="mb-2" :option="$sequence_no !== 1 ? '任意' : '必須'" />
        <x-text-input id="{{ $key }}" class="block mt-1 w-full" type="text" name="{{ $name }}"
            :value="old($key) ?? ($userVehicle ? $userVehicle->car_number : null)" :required="$sequence_no === 1 ? true : false" />
        <x-ajax-input-error id="error-{{ $errorKey }}" class="mt-2" />
        <x-input-error :messages="$errors->get($key)" class="mt-2" />
    </div>

    <!-- Car Class {{ $sequence_no }} -->
    @php
        $key = 'car_class_' . $sequence_no;
        $errorKey = 'car_class_' . ($sequence_no - 1);
        $name = 'car_class[]';
    @endphp
    <div id="container-{{ $key }}" class="mt-4">
        <x-text.custom-input-label text="車種区分({{ $sequence_no }}台目)" class="mb-2" :option="$sequence_no !== 1 ? '任意' : '任意'" />
        @foreach (\App\Enums\CarClassEnum::cases() as $carClass)
            <div class="mt-4 flex items-center gap-3 mb-3">
                <x-text-input id="{{ $key }}_{{ $carClass->value }}" type="radio"
                    name="{{ $name }}" :value="$carClass->value" :checked="(old($key) ?? ($userVehicle ? $userVehicle->car_class : null)) == $carClass->value" />
                <x-input-label for="{{ $key }}_{{ $carClass->value }}" :value="__($carClass->getLabel())" />
            </div>
        @endforeach
        <x-ajax-input-error id="error-{{ $errorKey }}" class="mt-2" />
        <x-input-error :messages="$errors->get($key)" class="mt-2" />
    </div>
</div>
