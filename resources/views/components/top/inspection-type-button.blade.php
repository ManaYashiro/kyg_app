@props([
    'sequence_no' => 0, // 順番
    'value' => '', // 点検種別の値
])

<label for="inspection-type-input-{{ $sequence_no }}" class="custom-radio-button">
    <input type="radio" name="inspection_type" value="{{ $value }}" id="inspection-type-input-{{ $sequence_no }}"
        class="hidden-radio step-radio rounded-md">
    <span class="step-button inspection-type-button flex flex-col">
        <div class="flex gap-2 w-[45%] items-center justify-center btn-img-container">
            @switch($value)
                @case('車検')
                    <img src="{{ Vite::asset('resources/img/top/active_inspection.png') }}" alt="{{ $value }}"
                        class="w-[50%] active-icon">
                    <img src="{{ Vite::asset('resources/img/top/inactive_inspection.png') }}" alt="{{ $value }}"
                        class="w-[50%] inactive-icon">
                @break

                @default
                    <img src="{{ Vite::asset('resources/img/top/active_maintenance.png') }}" alt="{{ $value }}"
                        class="w-[50%] active-icon">
                    <img src="{{ Vite::asset('resources/img/top/inactive_maintenance.png') }}" alt="{{ $value }}"
                        class="w-[50%] inactive-icon">
                    <img src="{{ Vite::asset('resources/img/top/active_estimate.png') }}" alt="{{ $value }}"
                        class="w-[50%] active-icon">
                    <img src="{{ Vite::asset('resources/img/top/inactive_estimate.png') }}" alt="{{ $value }}"
                        class="w-[50%] inactive-icon">
                @break
            @endswitch
        </div>
        <span class="check-icon">
            <img src="{{ Vite::asset('resources/img/top/button_check.png') }}" alt="チェック" class="">
        </span>
        <span id="inspection-type-span-{{ $sequence_no }}">{{ $value }}</span>
    </span>
</label>
