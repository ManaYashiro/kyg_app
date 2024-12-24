<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white h-full overflow-hidden shadow-sm border border-gray-800 border-r-0 border-b-0">
        <div class="h-full overflow-y-auto p-2 md:p-6 text-gray-900">
            <h2 class="text-base/7 font-semibold text-gray-900">アンケート変更</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <input type="hidden" name="anket_id" id="anket_id" autocomplete="off">

                <!-- Name -->
                <div class="sm:col-span-3">
                    <x-input-label for="name" :value="__('名前')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name') ?? $anket->name" readonly />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Name -->
                <div class="sm:col-span-3">
                    <x-input-label for="short_name" :value="__('短い名')" />
                    <x-text-input id="short_name" class="block mt-1 w-full" type="text" name="short_name"
                        :value="old('short_name') ?? $anket->short_name" readonly />
                    <x-input-error :messages="$errors->get('short_name')" class="mt-2" />
                </div>
            </div>
        </div>
    </div>
    @section('styles')
    @endsection
    @push('modals')
    @endpush
    @push('scripts')
    @endpush
</x-admin-app-layout>
