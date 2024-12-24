<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight font-color-r">
            {{ __('登録情報の変更') }}
        </h2>
    </x-slot>

    <div class="bg-white h-full overflow-hidden shadow-sm border border-gray-800 border-r-0 border-b-0">
        <div class="h-full overflow-y-auto p-2 md:p-6 text-gray-900">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')
                <!-- name -->
                <div>
                    <x-input-label for="name" :value="__('名前')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $users->name ?? '')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- name_furigana -->
                <div class="mt-4">
                    <x-input-label for="name_furigana" :value="__('フリガナ')" />
                    <x-text-input id="name_furigana" class="block mt-1 w-full" type="text" name="name_furigana"
                        :value="old('name_furigana', $users->name_furigana ?? '')" required />
                    <x-input-error :messages="$errors->get('name_furigana')" class="mt-2" />
                </div>

                <!-- mail address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('メールアドレス')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="text" name="email"
                        :value="old('email', $users->email ?? '')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('パスワード')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="text" type="password"
                        name="password" placeholder="変更する場合のみ入力してください" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('パスワード確認')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- phohe number -->
                <div class="mt-4">
                    <x-input-label for="phone_number" :value="__('電話番号')" />
                    <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                        :value="old('phone_number', $users->phone_number ?? '')" required />
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>

                <!-- zipcode -->
                <div class="mt-4">
                    <x-input-label for="zipcode" :value="__('郵便番号')" />
                    <div class="flex items-center space-x-2">
                        <x-text-input id="zipcode" class="block mt-1 w-full" type="text" name="zipcode"
                            :value="old('zipcode', $users->zipcode ?? '')" required />

                        <!-- 検索ボタン -->
                        <button type="button" id="search-postcode"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md font-semibold text-xs hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300"
                            style="width: 7%; writing-mode: horizontal-tb;">
                            検索
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('zipcode')" class="mt-2" />
                </div>

                <!-- Address 1 -->
                <div class="mt-4">
                    <x-input-label for="address1" :value="__('住所')" />
                    <x-text-input id="address1" class="block mt-1 w-full" type="text" name="address1"
                        :value="old('address1', $users->address1 ?? '')" required />
                    <x-input-error :messages="$errors->get('address1')" class="mt-2" />
                </div>

                <!-- Address 2 -->
                <div class="mt-4">
                    <x-input-label for="address2" :value="__('建物')" />
                    <x-text-input id="address2" class="block mt-1 w-full" type="text" name="address2"
                        :value="old('name', $users->address2 ?? '')" />
                    <x-input-error :messages="$errors->get('address2')" class="mt-2" />
                </div>

                <!-- newsletter_subscription-->
                <div class="mt-4">
                    <x-input-label for="is_receive_newsletter" :value="__('メルマガ配信')" />
                    <div class="ml-1 mt-2 flex flex-row gap-3 items-center">
                        <x-text-input id="is_receive_newsletter" type="checkbox" name="is_receive_newsletter"
                            :value="1" :checked="old('is_receive_newsletter', $users->is_receive_newsletter ?? false)
                                ? true
                                : false" />
                        <x-input-label for="is_receive_newsletter" :value="__('受け取る')" />
                        <x-input-error :messages="$errors->get('is_receive_newsletter')" class="mt-2" />
                    </div>
                </div>

                <!-- notification_subscription-->
                <div class="mt-4">
                    <x-input-label for="is_receive_notification" :value="__('店からのお知らせメール')" />
                    <div class="ml-1 mt-2 flex flex-row gap-3 items-center">
                        <x-text-input id="is_receive_notification" type="checkbox" name="is_receive_notification"
                            :value="1" :checked="old('is_receive_notification', $users->is_receive_notification ?? false)
                                ? true
                                : false" />
                        <x-input-label for="is_receive_notification" :value="__('受け取る')" />
                        <x-input-error :messages="$errors->get('is_receive_notification')" class="mt-2" />
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
</x-app-layout>
