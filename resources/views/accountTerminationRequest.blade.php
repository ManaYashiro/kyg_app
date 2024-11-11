<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight font-color-r">
            {{ __('退会申請') }}
        </h2>
        <div class="flex space-x-2 mt-2">
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden sm:rounded-lg">

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- password -->
                                    <div class="mt-4">
                                        <x-input-label for="password" :value="__('現在のパスワード')" />
                                        <x-text-input id="password" class="block mt-1 w-full" type="text"
                                            name="password" :value="old('password')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- newsletter_subscription-->
                                    <div class="mt-4">
                                        <x-input-label for="preferred_contact_time" :value="__('会員登録を解除します')" />
                                        <x-checkbox name="terms" value="1" label="同意します" :checked="old('terms', false)"
                                        :disabled="false" />
                                        <x-input-error :messages="$errors->get('newsletter_subscription')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="ms-3">
                                            {{ __('退会') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
