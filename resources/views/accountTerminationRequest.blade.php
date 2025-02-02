<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight font-color-r">
            {{ __('退会申請') }}
        </h2>
        <div class="flex space-x-2 mt-2">
        </div>
    </x-slot>

    <div class="bg-white h-full overflow-hidden shadow-sm border border-gray-800 border-r-0 border-b-0">
        <div class="h-full overflow-y-auto p-2 md:p-6 text-gray-900">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE') <!-- DELETEメソッドを指定 -->

                <!-- 現在のパスワード -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('現在のパスワード')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                        :value="old('password')" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- 退会同意 -->
                <div class="mt-4">
                    <x-input-label for="withdrawal" :value="__('会員登録を解除します')" />
                    <div class="ml-1 mt-2 flex flex-row gap-3 items-center">
                        <x-text-input id="withdrawal" type="checkbox" name="withdrawal" :checked="old('withdrawal') ? true : false" />
                        <x-input-label for="withdrawal" :value="__('同意します')" />
                    </div>
                    <x-input-error :messages="$errors->get('withdrawal')" class="mt-2" />
                </div>

                <!-- 退会ボタン -->
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('退会') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
