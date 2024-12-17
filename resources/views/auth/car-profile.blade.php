@props([
    'no' => '',
    'userVehicles' => null,
])

@php
    $open = $no . '台目：開く';
    $close = $no . '台目：閉る';
@endphp

<button type="button" class="max-w-[100px]  bg-red-300 hover:bg-red-400 text-white text-sm font-normal p-2 rounded"
    @click="car_{{ $no }} = !car_{{ $no }}"
    x-text="car_{{ $no }} === true ? '{{ $open }}' : '{{ $close }}'"></button>
<div class="relative overflow-hidden duration-700" x-ref="containerCar_{{ $no }}"
    x-bind:class="{ 'max-h-0': !car_{{ $no }} }"
    x-bind:style="car_{{ $no }} == true ? 'max-height: ' + height + 'px' : ''" x-cloak
    x-transition:enter="transition-all ease-in duration-300" x-transition:enter-start="opacity-0 max-h-0"
    x-transition:enter-end="opacity-100 max-h-screen" x-transition:leave="transition-all ease-out duration-300"
    x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0">

    <!-- Car Name {{ $no }} -->
    @php
        $key = 'car' . $no . '_name';
    @endphp
    <div id="container-{{ $key }}" class="mt-4">
        <x-text.custom-input-label text="車名({{ $no }}台目)" class="mb-2" :option="$no !== 1 ? '任意' : '必須'" />
        <x-text-input id="{{ $key }}" class="block mt-1 w-full" type="text" name="{{ $key }}"
            :value="old($key) ?? ($userVehicles ? $userVehicles->$key : null)" :required="$no === 1 ? true : false" />
        <x-ajax-input-error id="error-{{ $key }}" class="mt-2" />
        <x-input-error :messages="$errors->get($key)" class="mt-2" />
    </div>

    <!-- Car Katashiki {{ $no }} -->
    @php
        $key = 'car' . $no . '_katashiki';
    @endphp
    <div id="container-{{ $key }}" class="mt-4">
        <x-text.custom-input-label text="型式({{ $no }}台目)" class="mb-2" :option="$no !== 1 ? '任意' : '任意'" />
        <x-text-input id="{{ $key }}" class="block mt-1 w-full" type="text" name="{{ $key }}"
            :value="old($key) ?? ($userVehicles ? $userVehicles->$key : null)" />
        <x-ajax-input-error id="error-{{ $key }}" class="mt-2" />
        <x-input-error :messages="$errors->get($key)" class="mt-2" />
    </div>

    <!-- Car Number {{ $no }} -->
    @php
        $key = 'car' . $no . '_number';
    @endphp
    <div id="container-{{ $key }}" class="mt-4">
        <x-text.custom-input-label text="ナンバー({{ $no }}台目)" class="mb-2" :option="$no !== 1 ? '任意' : '必須'" />
        <x-text-input id="{{ $key }}" class="block mt-1 w-full" type="text" name="{{ $key }}"
            :value="old($key) ?? ($userVehicles ? $userVehicles->$key : null)" :required="$no === 1 ? true : false" />
        <x-ajax-input-error id="error-{{ $key }}" class="mt-2" />
        <x-input-error :messages="$errors->get($key)" class="mt-2" />
    </div>

    <!-- Car Class {{ $no }} -->
    @php
        $key = 'car' . $no . '_class';
    @endphp
    <div id="container-{{ $key }}" class="mt-4">
        <x-text.custom-input-label text="車種区分({{ $no }}台目)" class="mb-2" :option="$no !== 1 ? '任意' : '任意'" />
        @foreach (\App\Enums\CarClassEnum::cases() as $carClass)
            <div class="mt-4 flex items-center gap-3 mb-3">
                <x-text-input id="{{ $key }}_{{ $carClass->value }}" type="radio"
                    name="{{ $key }}" :value="$carClass->value" :checked="(old($key) ?? ($userVehicles ? $userVehicles->$key : null)) == $carClass->value" />
                <x-input-label for="{{ $key }}_{{ $carClass->value }}" :value="__($carClass->getLabel())" />
            </div>
        @endforeach
        <x-ajax-input-error id="error-{{ $key }}" class="mt-2" />
        <x-input-error :messages="$errors->get($key)" class="mt-2" />
    </div>
</div>
