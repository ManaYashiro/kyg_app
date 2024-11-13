<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" autocomplete="off">
        @csrf

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('名前')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Furigana -->
        <div class="mt-4">
            <x-input-label for="furigana" :value="__('フリガナ')" />
            <x-text-input id="furigana" class="block mt-1 w-full" type="text" name="furigana" :value="old('furigana')"
                required />
            <x-input-error :messages="$errors->get('furigana')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('パスワード確認')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('電話番号')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                :value="old('phone_number')" required />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- post code -->
        <div class="mt-4">
            <x-input-label for="post_code" :value="__('郵便番号')" />
            <div class="flex items-center space-x-2">
                <x-text-input id="post_code" class="block mt-1 w-full flex-1" type="text" name="post_code"
                    :value="old('post_code')" required />

                <!-- 検索ボタン -->
                <button type="button" id="search-postcode"
                    class="px-4 py-3 bg-blue-500 text-white rounded-md font-semibold text-xs hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    検索
                </button>
            </div>
            <x-input-error :messages="$errors->get('post_code')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('住所')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                required />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Building -->
        <div class="mt-4">
            <x-input-label for="building" :value="__('建物')" />
            <x-text-input id="building" class="block mt-1 w-full" type="text" name="building" :value="old('building')" />
            <x-input-error :messages="$errors->get('building')" class="mt-2" />
        </div>

        <!-- Preferred Time -->
        <div class="mt-4">
            <x-input-label for="preferred_contact_time" :value="__('電話希望時間')" />
            <x-select id="preferred_contact_time" class="block mt-1 w-full" name="preferred_contact_time" required>
                <option value="" disabled {{ old('preferred_contact_time') == '' ? 'selected' : '' }}>選択してください
                </option>
                <option value="9-12" {{ old('preferred_contact_time') == '9-12' ? 'selected' : '' }}>9:00 - 12:00
                </option>
                <option value="12-13" {{ old('preferred_contact_time') == '12-13' ? 'selected' : '' }}>12:00 - 13:00
                </option>
                <option value="13-15" {{ old('preferred_contact_time') == '13-15' ? 'selected' : '' }}>13:00 - 15:00
                </option>
                <option value="15-17" {{ old('preferred_contact_time') == '15-17' ? 'selected' : '' }}>15:00 - 17:00
                </option>
                <option value="17-19" {{ old('preferred_contact_time') == '17-19' ? 'selected' : '' }}>17:00 - 19:00
                </option>
                <option value="no_preference" {{ old('preferred_contact_time') == 'no_preference' ? 'selected' : '' }}>
                    指定なし</option>
            </x-select>
            <x-input-error :messages="$errors->get('preferred_contact_time')" class="mt-2" />
        </div>

        <!-- How did you hear -->
        <div class="mt-6">
            <x-input-label for="anket-main" :value="__('アンケート')" />
            <x-input-label for="anket-main" :value="__('弊社の車検を何でお知りになりましたか')" />
            @foreach ($how_did_you_hear as $anket)
                <div class="mt-4 flex items-center gap-3 mb-3">
                    <x-text-input id="anket-{{ $anket->id }}" type="checkbox" name="how_did_you_hear[]"
                        :value="$anket->id" :checked="in_array($anket->id, old('how_did_you_hear', []))" />
                    <x-input-label for="anket-{{ $anket->id }}" :value="$anket->name" />
                </div>
            @endforeach
        </div>

        <!-- Newsletter Subscription -->
        <div class="mt-6">
            <x-input-label for="is_newsletter_subscription" :value="__('ショップからのお知らせを受け取る')" />
            <div class="mt-4 flex flex-row gap-3 items-center">
                <x-text-input id="is_newsletter_subscription" type="checkbox" name="is_newsletter_subscription"
                    :value="1" :checked="old('is_newsletter_subscription') ? true : false" />
                <x-input-label for="is_newsletter_subscription" :value="__('受け取る')" />
                <x-input-error :messages="$errors->get('is_newsletter_subscription')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('すでに登録済みですか?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('登録') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
