<x-guest-layout>

    <form method="POST" action="{{ route('register') }}" autocomplete="off">
        @csrf
        <x-text.custom-text text="会員登録" class="mb-3 bottom-border-text font-bold" />
        <div class="mt-3 flex flex-col gap-1">
            <x-text.custom-text text="各項目をご入力の上、[次へ進む] ボタンをクリックしてください。" class="text-xs" />
            <x-text.custom-text text="会員登録後、ご入力いただいたメールアドレス宛に会員登録完了の" class="text-xs" />
            <x-text.custom-text text="メールが自動配信されます。" class="text-xs" />
            <x-text.custom-text text="※24時間経過してもメールが配信されない場合は、右上メニュー内にある「よくある質問」からQ3をご確認ください。"
                class="text-xs text-red-500" />
        </div>

        <x-text.custom-text text="ログイン情報" class="mt-6 mb-2 text-sm bg-gray-text" />
        <!-- Login ID -->
        <div class="mt-4">
            <x-text.custom-input-label text="ログインID" class="mb-2" option="必須" />
            <x-text-input id="loginid" class="block mt-1 w-full" type="text" name="loginid" :value="old('loginid')"
                required autofocus />
            <x-input-error :messages="$errors->get('loginid')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-text.custom-input-label text="パスワード" class="mb-2" option="必須" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-text.custom-text text="基本情報" class="mt-6 mb-2 text-sm bg-gray-text" />
        <!-- Name -->
        <div class="mt-4">
            <x-text.custom-input-label text="顧客名" class="mb-2" option="必須" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Furigana -->
        <div class="mt-4">
            <x-text.custom-input-label text="フリガナ" class="mb-2" option="必須" />
            <x-text-input id="furigana" class="block mt-1 w-full" type="text" name="furigana" :value="old('furigana')"
                required />
            <x-input-error :messages="$errors->get('furigana')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-text.custom-input-label text="メールアドレス" class="mb-2" option="必須" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-text.custom-input-label text="電話番号" class="mb-2" option="必須" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                :value="old('phone_number')" required />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Preferred Time -->
        <div class="mt-4">
            <x-text.custom-input-label text="電話希望時間" class="mb-2" option="必須" />
            <div class="mt-4 flex items-center gap-3 mb-3">
                <x-text-input id="contact-time-1" type="radio" name="preferred_contact_time" value="9-12"
                    :checked="old('preferred_contact_time') == '9-12'" />
                <x-input-label for="contact-time-1" :value="'9:00 - 12:00'" />
            </div>
            <div class="mt-4 flex items-center gap-3 mb-3">
                <x-text-input id="contact-time-1" type="radio" name="preferred_contact_time" value="12-13"
                    :checked="old('preferred_contact_time') == '12-13'" />
                <x-input-label for="contact-time-1" :value="'12:00 - 13:00'" />
            </div>
            <div class="mt-4 flex items-center gap-3 mb-3">
                <x-text-input id="contact-time-1" type="radio" name="preferred_contact_time" value="13-15"
                    :checked="old('preferred_contact_time') == '13-15'" />
                <x-input-label for="contact-time-1" :value="'13:00 - 15:00'" />
            </div>
            <div class="mt-4 flex items-center gap-3 mb-3">
                <x-text-input id="contact-time-1" type="radio" name="preferred_contact_time" value="15-17"
                    :checked="old('preferred_contact_time') == '15-17'" />
                <x-input-label for="contact-time-1" :value="'15:00 - 17:00'" />
            </div>
            <div class="mt-4 flex items-center gap-3 mb-3">
                <x-text-input id="contact-time-1" type="radio" name="preferred_contact_time" value="17-19"
                    :checked="old('preferred_contact_time') == '17-19'" />
                <x-input-label for="contact-time-1" :value="'17:00 - 19:00'" />
            </div>
            <div class="mt-4 flex items-center gap-3 mb-3">
                <x-text-input id="contact-time-1" type="radio" name="preferred_contact_time" value="no_preference"
                    :checked="old('preferred_contact_time') == 'no_preference'" />
                <x-input-label for="contact-time-1" :value="'指定なし'" />
            </div>
            <x-input-error :messages="$errors->get('preferred_contact_time')" class="mt-2" />
        </div>

        <!-- Postal Code -->
        <div class="mt-4">
            <x-text.custom-input-label text="郵便番号" class="mb-2" option="必須" />
            <div class="flex items-center space-x-2">
                <x-text-input id="post_code" class="block mt-1 flex-1" type="text" name="post_code"
                    :value="old('post_code')" required />

                <!-- 検索ボタン -->
                <button type="button" id="search-postcode"
                    class="px-4 py-3 bg-blue-500 text-white rounded-md font-semibold text-xs hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    検索
                </button>
            </div>
            <x-input-error :messages="$errors->get('post_code')" class="mt-2" />
        </div>

        {{-- TODO add prefecture・都道府県 in DB --}}
        <div class="mt-4">
            <x-text.custom-input-label text="都道府県" class="mb-2" option="必須" />
            <select name="prefecture" id="prefecture"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">▼都道府県を選択</option>
                <optgroup label="---北海道---">
                    <option value="北海道">北海道</option>
                </optgroup>
                <optgroup label="---東北地区---">
                    <option value="青森県">青森県</option>
                    <option value="岩手県">岩手県</option>
                    <option value="宮城県">宮城県</option>
                    <option value="秋田県">秋田県</option>
                    <option value="山形県">山形県</option>
                    <option value="福島県">福島県</option>
                </optgroup>
                <optgroup label="---関東信越地区---">
                    <option value="茨城県">茨城県</option>
                    <option value="栃木県">栃木県</option>
                    <option value="群馬県">群馬県</option>
                    <option value="埼玉県">埼玉県</option>
                    <option value="千葉県">千葉県</option>
                    <option value="東京都">東京都</option>
                    <option value="神奈川県">神奈川県</option>
                    <option value="山梨県">山梨県</option>
                    <option value="長野県">長野県</option>
                    <option value="新潟県">新潟県</option>
                </optgroup>
                <optgroup label="---中部地区---">
                    <option value="静岡県">静岡県</option>
                    <option value="愛知県">愛知県</option>
                    <option value="岐阜県">岐阜県</option>
                    <option value="三重県">三重県</option>
                </optgroup>
                <optgroup label="---北陸地区---">
                    <option value="富山県">富山県</option>
                    <option value="石川県">石川県</option>
                    <option value="福井県">福井県</option>
                </optgroup>
                <optgroup label="---近畿地区---">
                    <option value="滋賀県">滋賀県</option>
                    <option value="京都府">京都府</option>
                    <option value="大阪府">大阪府</option>
                    <option value="兵庫県">兵庫県</option>
                    <option value="奈良県">奈良県</option>
                    <option value="和歌山県">和歌山県</option>
                </optgroup>
                <optgroup label="---中国地区---">
                    <option value="鳥取県">鳥取県</option>
                    <option value="島根県">島根県</option>
                    <option value="岡山県">岡山県</option>
                    <option value="広島県">広島県</option>
                    <option value="山口県">山口県</option>
                </optgroup>
                <optgroup label="---四国地区---">
                    <option value="徳島県">徳島県</option>
                    <option value="香川県">香川県</option>
                    <option value="愛媛県">愛媛県</option>
                    <option value="高知県">高知県</option>
                </optgroup>
                <optgroup label="---九州地区---">
                    <option value="福岡県">福岡県</option>
                    <option value="佐賀県">佐賀県</option>
                    <option value="長崎県">長崎県</option>
                    <option value="熊本県">熊本県</option>
                    <option value="大分県">大分県</option>
                    <option value="宮崎県">宮崎県</option>
                    <option value="鹿児島県">鹿児島県</option>
                </optgroup>
                <optgroup label="---沖縄---">
                    <option value="沖縄県">沖縄県</option>
                </optgroup>
                <optgroup label="---その他---">
                    <option value="海外">海外</option>
                </optgroup>
            </select>
        </div>


        <!-- Address -->
        <div class="mt-4">
            <x-text.custom-input-label text="市区町村・番地" class="mb-2" option="必須" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                required />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Building -->
        <div class="mt-4">
            <x-text.custom-input-label text="建物名など" class="mb-2" option="任意" />
            <x-text-input id="building" class="block mt-1 w-full" type="text" name="building"
                :value="old('building')" />
            <x-input-error :messages="$errors->get('building')" class="mt-2" />
        </div>

        <!-- Newsletter Subscription -->
        <div class="mt-6">
            <x-text.custom-input-label text="メルマガ配信" class="mb-2" option="任意" />
            <div class="mt-4 flex flex-col gap-2 justify-center items-start">
                <div class="my-1 flex items-center gap-3">
                    <x-text-input id="contact-time-1" type="radio" name="is_receive_newsletter" value="1"
                        :checked="old('is_receive_newsletter') == '1'" />
                    <x-input-label for="is_receive_newsletter" :value="__('受けする')" />
                </div>
                <div class="my-1 flex items-center gap-3">
                    <x-text-input id="contact-time-1" type="radio" name="is_receive_newsletter" value="0"
                        :checked="old('is_receive_newsletter') == '0'" />
                    <x-input-label for="is_receive_newsletter" :value="__('受けしない')" />
                </div>
                <x-input-error :messages="$errors->get('is_receive_newsletter')" class="mt-2" />
            </div>
        </div>

        <!-- How did you hear -->
        <div class="mt-6">
            <x-text.custom-input-label text="【アンケート】弊社の車検を何でお知りになりましたか" class="mb-2" option="必須" />
            @foreach ($how_did_you_hear as $anket)
                <div class="mt-4 flex items-center gap-3 mb-3">
                    <x-text-input id="anket-{{ $anket->id }}" type="checkbox" name="how_did_you_hear[]"
                        :value="$anket->id" :checked="in_array($anket->id, old('how_did_you_hear', []))" />
                    <x-input-label for="anket-{{ $anket->id }}" :value="$anket->name" />
                </div>
            @endforeach
            <x-input-error :messages="$errors->get('how_did_you_hear')" class="mt-2" />
        </div>

        {{-- TODO add manager and department in DB --}}
        <!-- Manager・担当者 -->
        <div class="mt-4">
            <x-text.custom-input-label text="担当者" class="mb-2" option="任意" />
            <x-text-input id="manager" class="block mt-1 w-full" type="text" name="manager"
                :value="old('manager')" />
            <x-input-error :messages="$errors->get('manager')" class="mt-2" />
        </div>

        <!-- Department・ -->
        <div class="mt-4">
            <x-text.custom-input-label text="部署名／支店名" class="mb-2" option="任意" />
            <x-text-input id="department" class="block mt-1 w-full" type="text" name="department"
                :value="old('department')" />
            <x-input-error :messages="$errors->get('department')" class="mt-2" />
        </div>

        <!-- Notification Subscription -->
        <div class="mt-6">
            <x-text.custom-input-label text="店からのお知らせメール" class="mb-2" option="必須" />
            <div class="mt-4 flex flex-col gap-2 justify-center items-start">
                <div class="my-1 flex items-center gap-3">
                    <x-text-input id="contact-time-1" type="radio" name="is_receive_notification" value="1"
                        :checked="old('is_receive_notification') == '1'" />
                    <x-input-label for="is_receive_notification" :value="__('受けする')" />
                </div>
                <div class="my-1 flex items-center gap-3">
                    <x-text-input id="contact-time-1" type="radio" name="is_receive_notification" value="0"
                        :checked="old('is_receive_notification') == '0'" />
                    <x-input-label for="is_receive_notification" :value="__('受けしない')" />
                </div>
                <x-input-error :messages="$errors->get('is_receive_notification')" class="mt-2" />
            </div>
        </div>

        <div class="flex flex-col items-end justify-center gap-10 mt-4">
            <x-buttons.actionbutton name="{{ __('次へ進む') }}" type="submit" class="px-4 py-4" />
        </div>
    </form>
</x-guest-layout>
