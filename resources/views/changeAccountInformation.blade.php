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

                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PATCH')
                                    <!-- name -->
                                    <div>
                                        <x-input-label for="name" :value="__('名前')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text"
                                            name="name" :value="old('name', $users->name ?? '')" required autofocus />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <!-- furigana -->
                                    <div class="mt-4">
                                        <x-input-label for="furigana" :value="__('フリガナ')" />
                                        <x-text-input id="furigana" class="block mt-1 w-full" type="text"
                                            name="furigana" :value="old('furigana', $users->furigana ?? '')" required />
                                        <x-input-error :messages="$errors->get('furigana')" class="mt-2" />
                                    </div>

                                    <!-- furigana -->
                                    <div class="mt-4">
                                        <x-input-label for="email" :value="__('メールアドレス')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="text"
                                            name="email" :value="old('email', $users->email ?? '')" required />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- password -->
                                    <div class="mt-4">
                                        <x-input-label for="password" :value="__('パスワード')" />
                                        <x-text-input id="password" class="block mt-1 w-full" type="text"
                                            name="password" :value="old('password', '')" placeholder="変更する場合のみ入力してください" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mt-4">
                                        <x-input-label for="password_confirmation" :value="__('パスワード確認')" />
                                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password" name="password_confirmation" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <!-- phohe number -->
                                    <div class="mt-4">
                                        <x-input-label for="phone_number" :value="__('電話番号')" />
                                        <x-text-input id="phone_number" class="block mt-1 w-full" type="text"
                                            name="phone_number" :value="old('phone_number', $users->phone_number ?? '')" required />
                                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                                    </div>

                                    <!-- post code -->
                                    <div class="mt-4">
                                        <x-input-label for="post_code" :value="__('郵便番号')" />
                                        <div class="flex items-center space-x-2">
                                            <x-text-input id="post_code" class="block mt-1 w-full" type="text" name="post_code" :value="old('post_code', $users->post_code ?? '')" required />

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
                                            name="address" :value="old('address', $users->address ?? '')" required />
                                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                    </div>

                                    <!-- building -->
                                    <div class="mt-4">
                                        <x-input-label for="building" :value="__('建物')" />
                                        <x-text-input id="building" class="block mt-1 w-full" type="text"
                                            name="building" :value="old('name', $users->building ?? '')" />
                                        <x-input-error :messages="$errors->get('building')" class="mt-2" />
                                    </div>

                                    <!-- newsletter_subscription-->
                                    <div class="mt-4">
                                        <x-input-label for="is_newsletter_subscription" :value="__('ショップからのお知らせを受け取る')" />
                                        <div class="ml-1 mt-2 flex flex-row gap-3 items-center">
                                            <x-text-input id="is_newsletter_subscription" type="checkbox"
                                                name="is_newsletter_subscription" :value="1"
                                                :checked="old('is_newsletter_subscription', $users->is_newsletter_subscription ?? false, ) ? true : false" />
                                            <x-input-label for="is_newsletter_subscription" :value="__('受け取る')" />
                                            <x-input-error :messages="$errors->get('is_newsletter_subscription')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="ms-3">
                                            {{ __('更新') }}
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
