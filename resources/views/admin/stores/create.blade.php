<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white h-full overflow-hidden shadow-sm border border-gray-800 border-r-0 border-b-0">
        <div class="h-full overflow-y-auto p-2 md:p-6 text-gray-900">
            <h2 class="text-base/7 font-semibold text-gray-900">店舗登録</h2>

            <form action="{{ route('admin.stores.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <input type="hidden" name="store_id" id="store_id" autocomplete="off">

                    <!-- Name -->
                    <div class="sm:col-span-3">
                        <x-input-label for="name" :value="__('名前')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="sm:col-span-3">
                        <x-input-label for="email" :value="__('メールアドレス')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>


                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <!-- Phone Number -->
                    <div class="sm:col-span-3">
                        <x-input-label for="phone_number" :value="__('電話番号')" />
                        <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                            :value="old('phone_number')" required />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>

                    <!-- Address -->
                    <div class="sm:col-span-3">
                        <x-input-label for="address" :value="__('住所')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                            :value="old('address')" required />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                </div>

                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">
                    登録
                </button>
            </form>
        </div>
    </div>
    @section('styles')
    @endsection
    @push('modals')
    @endpush
    @push('scripts')
    @endpush
</x-admin-app-layout>
