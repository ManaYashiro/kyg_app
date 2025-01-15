@props([
    'attributes' => [], // Additional button attributes
])

<div class="flex flex-row items-center justify-center gap-4 mt-4">
    <x-buttons.actionbutton name="{{ __('前の画面に戻る') }}" type="button" id="button-prev" class="px-4 py-4"
        divClass="w-1/3 hidden" :buttonColor="'bg-gray-200 text-black'" />
    <x-buttons.actionbutton name="{{ __('次へ進む') }}" type="button" id="button-next" class="px-4 py-4"
        divClass="w-1/3 block" />
    <x-buttons.actionbutton name="{{ __('登録する') }}" type="button" id="button-submit" class="px-4 py-4"
        divClass="w-1/3 hidden" />
</div>
