@props([
    'name' => '', // 店舗名
    'store_id' => 0, // 店舗ID
    'address' => '', // 店舗住所
])

<div class="flex gap-4 items-center justify-between {{ $store_id == 1 ? 'mt-4' : '' }}">
    <label class="custom-radio-button">
        <input type="radio" name="store" value="{{ $name }}" class="hidden-radio rounded-md">
        <span class="step01-button">
            <span class="check-icon">✓</span><span>{{ $name }}</span>
        </span>
    </label>
    {{-- mobi --}}
    <div class="flex md:hidden flex-col flex-grow gap-2 items-start md:flex-row md:items-center">
        <div class="font-bold px-2 text-xs text-left grow">{{ $address }}</div>
        <div class="step01-details text-red-600 font-bold text-xs px-2 text-right inline-block cursor-pointer"
            data-store-id="{{ $store_id }}"><span class="border-b border-red-600 ">さらに詳しく</span></div>
    </div>
    {{-- desktop --}}
    <div class="hidden flex-grow md:grid grid-cols-4 grid-rows-1 gap-2 items-start md:flex-row md:items-center">
        <div class="col-span-3 font-bold px-2 text-xs text-left grow">{{ $address }}</div>
        <div class="step01-details col-start-4 text-red-600 font-bold text-xs px-2 text-right inline-block cursor-pointer"
            data-store-id="{{ $store_id }}"><span class="border-b border-red-600 ">さらに詳しく</span></div>
    </div>
</div>
<hr class="my-3 border-1 border-red-600">
