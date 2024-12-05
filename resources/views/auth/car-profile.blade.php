@props([
    'no' => '',
])

<!-- Car Name {{ $no }} -->
<div id="container-car{{ $no }}_name" class="mt-4">
    <x-text.custom-input-label text="車名({{ $no }}台目)" class="mb-2" :option="$no !== 1 ? '任意' : '必須'" />
    <x-text-input id="car{{ $no }}_name" class="block mt-1 w-full" type="text"
        name="car{{ $no }}_name" :value="old('car' . $no . '_name')" required />
    <x-ajax-input-error id="error-car{{ $no }}_name" class="mt-2" />
    <x-input-error :messages="$errors->get('car' . $no . '_name')" class="mt-2" />
</div>

<!-- Car Katashiki {{ $no }} -->
<div id="container-car{{ $no }}_katashiki" class="mt-4">
    <x-text.custom-input-label text="型式({{ $no }}台目)" class="mb-2" :option="$no !== 1 ? '任意' : '任意'" />
    <x-text-input id="car{{ $no }}_katashiki" class="block mt-1 w-full" type="text"
        name="car{{ $no }}_katashiki" :value="old('car' . $no . '_katashiki')" required />
    <x-ajax-input-error id="error-car{{ $no }}_katashiki" class="mt-2" />
    <x-input-error :messages="$errors->get('car' . $no . '_katashiki')" class="mt-2" />
</div>

<!-- Car Number {{ $no }} -->
<div id="container-car{{ $no }}_number" class="mt-4">
    <x-text.custom-input-label text="ナンバー({{ $no }}台目)" class="mb-2" :option="$no !== 1 ? '任意' : '必須'" />
    <x-text-input id="car{{ $no }}_number" class="block mt-1 w-full" type="text"
        name="car{{ $no }}_number" :value="old('car' . $no . '_number')" required />
    <x-ajax-input-error id="error-car{{ $no }}_number" class="mt-2" />
    <x-input-error :messages="$errors->get('car' . $no . '_number')" class="mt-2" />
</div>

<!-- Car Class {{ $no }} -->
<div id="container-car{{ $no }}_class" class="mt-4">
    <x-text.custom-input-label text="車種区分({{ $no }}台目)" class="mb-2" :option="$no !== 1 ? '任意' : '任意'" />
    <div class="mt-4 flex items-center gap-3 mb-3">
        <x-text-input id="car{{ $no }}_class_1" type="radio" name="car{{ $no }}_class"
            :value="'軽自動車'" :checked="old('car' . $no . '_class') == '軽自動車'" />
        <x-input-label for="car{{ $no }}_class" :value="'軽自動車'" />
    </div>

    <div class="mt-4 flex items-center gap-3 mb-3">
        <x-text-input id="car{{ $no }}_class_2" type="radio" name="car{{ $no }}_class"
            :value="'小型乗用車(車両重量～1.0t)'" :checked="old('car' . $no . '_class') == '小型乗用車(車両重量～1.0t)'" />
        <x-input-label for="car{{ $no }}_class" :value="'小型乗用車(車両重量～1.0t)'" />
    </div>

    <div class="mt-4 flex items-center gap-3 mb-3">
        <x-text-input id="car{{ $no }}_class_3" type="radio" name="car{{ $no }}_class"
            :value="'中型乗用車(車両重量～1.5t)'" :checked="old('car' . $no . '_class') == '中型乗用車(車両重量～1.5t)'" />
        <x-input-label for="car{{ $no }}_class" :value="'中型乗用車(車両重量～1.5t)'" />
    </div>

    <div class="mt-4 flex items-center gap-3 mb-3">
        <x-text-input id="car{{ $no }}_class_4" type="radio" name="car{{ $no }}_class"
            :value="'大型乗用車(車両重量～2.0t)'" :checked="old('car' . $no . '_class') == '大型乗用車(車両重量～2.0t)'" />
        <x-input-label for="car{{ $no }}_class" :value="'大型乗用車(車両重量～2.0t)'" />
    </div>

    <div class="mt-4 flex items-center gap-3 mb-3">
        <x-text-input id="car{{ $no }}_class_5" type="radio" name="car{{ $no }}_class"
            :value="'大型乗用車(車両重量～2.5t)'" :checked="old('car' . $no . '_class') == '大型乗用車(車両重量～2.5t)'" />
        <x-input-label for="car{{ $no }}_class" :value="'大型乗用車(車両重量～2.5t)'" />
    </div>

    <div class="mt-4 flex items-center gap-3 mb-3">
        <x-text-input id="car{{ $no }}_class_6" type="radio" name="car{{ $no }}_class"
            :value="'上記以外'" :checked="old('car' . $no . '_class') == '上記以外'" />
        <x-input-label for="car{{ $no }}_class" :value="'上記以外'" />
    </div>
    <x-ajax-input-error id="error-car{{ $no }}_class" class="mt-2" />
    <x-input-error :messages="$errors->get('car' . $no . '_class')" class="mt-2" />
</div>
