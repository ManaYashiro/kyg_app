<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="border-b border-gray-900/10 mb-6">
                        <h2 class="text-base/7 font-semibold text-gray-900">店舗変更</h2>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <input type="hidden" name="store_id" id="store_id" autocomplete="off">

                            <!-- Name -->
                            <div class="sm:col-span-3">
                                <x-input-label for="name" :value="__('名前')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name') ?? $store->name" readonly />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="sm:col-span-3">
                                <x-input-label for="email" :value="__('メールアドレス')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email') ?? $store->email" readonly />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>


                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <!-- Phone Number -->
                            <div class="sm:col-span-3">
                                <x-input-label for="phone_number" :value="__('電話番号')" />
                                <x-text-input id="phone_number" class="block mt-1 w-full" type="text"
                                    name="phone_number" :value="old('phone_number') ?? $store->phone_number" readonly />
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>

                            <!-- Address -->
                            <div class="sm:col-span-3">
                                <x-input-label for="address" :value="__('住所')" />
                                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                    :value="old('address') ?? $store->address" readonly />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    @endpush
</x-admin-app-layout>
