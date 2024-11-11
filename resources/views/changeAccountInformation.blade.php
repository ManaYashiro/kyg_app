<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight font-color-r">
            {{ __('登録情報の変更') }}
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

                                    <!-- name -->
                                    <div>
                                        <x-input-label for="name" :value="__('名前')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text"
                                            name="name" :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <!-- furigana -->
                                    <div class="mt-4">
                                        <x-input-label for="furigana" :value="__('フリガナ')" />
                                        <x-text-input id="furigana" class="block mt-1 w-full" type="text"
                                            name="furigana" :value="old('furigana')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('furigana')" class="mt-2" />
                                    </div>

                                    <!-- furigana -->
                                    <div class="mt-4">
                                        <x-input-label for="email" :value="__('メールアドレス')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="text"
                                            name="email" :value="old('email')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- password -->
                                    <div class="mt-4">
                                        <x-input-label for="password" :value="__('パスワード')" />
                                        <x-text-input id="password" class="block mt-1 w-full" type="text"
                                            name="password" :value="old('password')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- phohe number -->
                                    <div class="mt-4">
                                        <x-input-label for="phone_number" :value="__('電話番号')" />
                                        <x-text-input id="phone_number" class="block mt-1 w-full" type="text"
                                            name="phone_number" :value="old('phone_number')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                                    </div>

                                    <!-- post code -->
                                    <div class="mt-4">
                                        <x-input-label for="post_code" :value="__('郵便番号')" />
                                        <div class="flex items-center space-x-2">
                                            <x-text-input id="post_code" class="block mt-1 w-full" type="text"
                                                name="post_code" :value="old('post_code')" required autocomplete="username" />

                                            <!-- 検索ボタン -->
                                            <button type="button" id="search-postcode"
                                                class="px-4 py-2 bg-blue-500 text-white rounded-md font-semibold text-xs hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                                style="width: 7%; writing-mode: horizontal-tb;">
                                                検索
                                            </button>
                                        </div>
                                        <x-input-error :messages="$errors->get('post_code')" class="mt-2" />
                                    </div>

                                    <!-- address -->
                                    <div class="mt-4">
                                        <x-input-label for="address" :value="__('住所')" />
                                        <x-text-input id="address" class="block mt-1 w-full" type="text"
                                            name="address" :value="old('address')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                    </div>

                                    <!-- building -->
                                    <div class="mt-4">
                                        <x-input-label for="building" :value="__('建物')" />
                                        <x-text-input id="building" class="block mt-1 w-full" type="text"
                                            name="building" :value="old('building')" autocomplete="username" />
                                        <x-input-error :messages="$errors->get('building')" class="mt-2" />
                                    </div>

                                    <!-- newsletter_subscription-->
                                    <div class="mt-4">
                                        <x-input-label for="preferred_contact_time" :value="__('ショップからのお知らせを受け取る')" />
                                        <x-checkbox name="terms" value="1" label="受け取る" :checked="old('terms', false)"
                                        :disabled="false" />
                                        <x-input-error :messages="$errors->get('newsletter_subscription')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="ms-3">
                                            {{ __('登録') }}
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
