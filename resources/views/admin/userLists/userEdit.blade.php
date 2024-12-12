<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>


    <form id="form-user-register" class="multiPageForm" method="POST" action="{{ $route ?? route('register') }}"
        autocomplete="off">
        @csrf
        @if (isset($route))
            @method('PATCH')
        @endif

        <div id="page-1" class="page block">
            @include('auth.user-profile', [
                'formType' => $formType,
                'submitType' => $submitType,
                'user' => $user ?? [],
            ])
        </div>

        <!-- 更新ボタン -->
        <div class="mb-4 flex justify-end">
            <!-- 更新ボタン -->
            <x-primary-button class="ms-3">更新</x-primary-button>
        </div>
    </form>

    <!-- 削除ボタン -->
    <form action="{{ route('admin.userList.destroy', $user->id) }}" method="POST"
        onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        @method('DELETE')
        <div class="mb-4 flex justify-end">
            <button type="submit"
                class="ms-3 bg-red-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-800 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                削除
            </button>
        </div>
    </form>

    <!-- 前の画面に戻るボタン -->
    <div class="mb-4 flex justify-end">
        <button onclick="window.history.back()"
            class="ms-3 bg-gray-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            前の画面に戻る
        </button>
    </div>

    @section('styles')
    @endsection
    @push('scripts')
        @vite(['resources/js/modules/ajaxConfirm.js'])
        @vite(['resources/js/modules/page-navi-buttons.js'])
        @vite(['resources/js/modules/auth/register.js'])
    @endpush

    {{-- <div class="py-12">
        <div class="mx-auto" style="max-width: 90rem;">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto mt-4">
                        <div class="container mx-auto p-4">
                            <h2 class="text-xl font-semibold mb-4">ユーザー情報編集</h2>

                            @if (session('success'))
                                <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('admin.userList.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="my-3">ログイン情報</div>

                                <!-- Role -->
                                <div id="container-role" class="mb-4">
                                    <x-text.custom-input-label text="Role" class="mb-2" option="必須" />
                                    <x-select id="Role" class="block mt-1 w-full" name="Role" :value="old('Role', $user->Role ?? '')"
                                        required autofocus>
                                        <option value="" disabled>{{ __('Select Role') }}</option>
                                        <option value="admin"
                                            {{ old('Role', $user->Role ?? '') == 'admin' ? 'selected' : '' }}>
                                            {{ __('Admin') }}</option>
                                        <option value="user"
                                            {{ old('Role', $user->Role ?? '') == 'user' ? 'selected' : '' }}>
                                            {{ __('User') }}</option>
                                    </x-select>
                                    <x-input-error :messages="$errors->get('Role')" class="mt-2" />
                                </div>

                                <!-- Login ID -->
                                <div id="container-loginid" class="mb-4">
                                    <x-text.custom-input-label text="ログインID" class="mb-2" option="必須" />
                                    <x-text-input id="loginid" class="block mt-1 w-full" type="text" name="loginid"
                                        :value="old('loginid', $user->loginid ?? '')" required autofocus />
                                    <x-text.custom-input-label text="※半角英数字 4文字以上で入力してください。"
                                        spanClass="font-normal text-xs text-gray-500 mt-1" />
                                    <x-ajax-input-error id="error-loginid" class="mt-2" />
                                    <x-input-error :messages="$errors->get('loginid')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div id="container-password" class="mb-4">
                                    <x-text.custom-input-label text="パスワード" class="mb-2" option="任意" />
                                    <x-text-input id="password" class="block mt-1 w-full" type="password"
                                        name="password" required />
                                    <x-text.custom-input-label text="※半角英数字 4～20文字で入力してください。"
                                        spanClass="font-normal text-xs text-gray-500 mt-1" />
                                    <x-ajax-input-error id="error-password" class="mt-2" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div id="container-password_confirmation" class="mt-4">
                                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                        name="password_confirmation" required />
                                    <x-text.custom-input-label text="※確認のためにもう一度パスワードを入力してください。"
                                        spanClass="font-normal text-xs text-gray-500 mt-1" />
                                    <x-ajax-input-error id="error-password_confirmation" class="mt-2" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                                <div class="my-3">基本情報</div>

                                <!-- Name -->
                                <div id="container-name" class="mb-4">
                                    <x-text.custom-input-label text="顧客名" class="mb-2" option="必須" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                        :value="old('name', $user->name ?? '')" required />
                                    <x-ajax-input-error id="error-name" class="mt-2" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Name Furigana -->
                                <div id="container-name_furigana" class="mb-4">
                                    <x-text.custom-input-label text="フリガナ" class="mb-2" option="必須" />
                                    <x-text-input id="name_furigana" class="block mt-1 w-full" type="text"
                                        name="name_furigana" :value="old('name_furigana', $user->name_furigana ?? '')" required />
                                    <x-ajax-input-error id="error-name_furigana" class="mt-2" />
                                    <x-input-error :messages="$errors->get('name_furigana')" class="mt-2" />
                                </div>

                                <!-- Birthday -->
                                <div id="container-birthday" class="mb-4">
                                    <x-text.custom-input-label text="生年月日" class="mb-2" option="必須" />
                                    <x-text-input id="birthday" type="text" name="birthday" :value="old('birthday', $user->birthday ?? '')"
                                        class="datepicker block mt-1 w-full md:w-1/4" required />
                                    <x-ajax-input-error id="error-birthday" class="mt-2" />
                                    <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
                                </div>

                                <!-- Gender -->
                                <div id="container-gender" class="mb-4">
                                    <x-text.custom-input-label text="性別" class="mb-2" option="任意" />
                                    <div class="flex flex-col gap-2 justify-center items-start">
                                        @foreach (\App\Enums\GenderEnum::cases() as $gender)
                                            <div class="my-1 flex items-center gap-3">
                                                <x-text-input id="gender-{{ $gender->value }}" type="radio"
                                                    name="gender" :value="$gender->value" :checked="old('gender', $user->gender->value) == $gender->value" />
                                                <x-input-label for="gender-{{ $gender->value }}" :value="__($gender->getLabel())" />
                                            </div>
                                        @endforeach
                                    </div>
                                    <x-ajax-input-error id="error-gender" class="mt-2" />
                                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                </div>

                                <!-- Email Address -->
                                <div id="container-email" class="mb-4">
                                    <x-text.custom-input-label text="メールアドレス" class="mb-2" option="必須" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email"
                                        name="email" :value="old('email', $user->email ?? '')" required />
                                    <x-text.custom-input-label text="PCまたは携帯のアドレスをご入力ください。"
                                        spanClass="font-normal text-xs text-gray-500 mt-1" />
                                    <x-ajax-input-error id="error-email" class="mt-2" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Phone Number -->
                                <div id="container-phone_number" class="mb-4">
                                    <x-text.custom-input-label text="電話番号" class="mb-2" option="必須" />
                                    <x-text-input id="phone_number" class="block mt-1 w-full" type="text"
                                        name="phone_number" :value="old('phone_number', $user->phone_number ?? '')" required />
                                    <x-text.custom-input-label text="※- （ハイフン）なしで記入　11桁以内"
                                        spanClass="font-normal text-xs text-gray-500 mt-1" />
                                    <x-text.custom-input-label text="※自宅または携帯の番号をご入力下さい。"
                                        spanClass="font-normal text-xs text-gray-500 mt-1" />
                                    <x-ajax-input-error id="error-phone_number" class="mt-2" />
                                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                                </div>

                                <!-- Preferred Time -->
                                <div id="container-call_time" class="mb-4">
                                    <x-text.custom-input-label text="電話希望時間" class="mb-2" option="必須" />

                                    @foreach (\App\Enums\CallTimeEnum::cases() as $callTime)
                                        <div class="mt-4 flex items-center gap-3 mb-3">
                                            <x-text-input id="contact-time-{{ $callTime->value }}" type="radio"
                                                name="call_time" :value="$callTime->value" :checked="old('call_time', $user->call_time) == $callTime->value" />
                                            <x-input-label for="contact-time-{{ $callTime->value }}"
                                                :value="__($callTime->getLabel())" />
                                        </div>
                                    @endforeach

                                    <x-ajax-input-error id="error-call_time" class="mt-2" />
                                    <x-input-error :messages="$errors->get('call_time')" class="mt-2" />
                                </div>

                                <!-- Postal Code -->
                                <div id="container-zipcode" class="mb-4">
                                    <x-text.custom-input-label text="郵便番号" class="mb-2" option="必須" />
                                    <div class="flex items-center space-x-2">
                                        <x-text-input id="zipcode" class="block mt-1 flex-1" type="text"
                                            name="zipcode" :value="old('zipcode', $user->zipcode ?? '')" required />

                                        <!-- 検索ボタン -->
                                        <button type="button" id="search-postcode"
                                            class="px-4 py-3 bg-blue-500 text-white rounded-md font-semibold text-xs hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                            検索
                                        </button>
                                    </div>
                                    <x-text.custom-input-label text="※- （ハイフン）なしで記入　7桁"
                                        spanClass="font-normal text-xs text-gray-500 mt-1" />
                                    <x-ajax-input-error id="error-zipcode" class="mt-2" />
                                    <x-input-error :messages="$errors->get('zipcode')" class="mt-2" />
                                </div>

                                <!-- Prefecture -->
                                <div id="prefecture" class="mb-4">
                                    <x-text.custom-input-label text="都道府県" class="mb-2" option="必須" />
                                    <x-select name="prefecture" id="prefecture" class="block mt-1 w-full md:w-1/4">
                                        <option value="" disabled
                                            {{ old('prefecture', $user->prefecture) == '' ? 'selected' : '' }}>▼都道府県を選択
                                        </option>
                                        <optgroup label="---北海道---">
                                            <option value="北海道"
                                                {{ old('prefecture', $user->prefecture) == '北海道' ? 'selected' : '' }}>
                                                北海道</option>
                                        </optgroup>
                                        <optgroup label="---東北地区---">
                                            <option value="青森県"
                                                {{ old('prefecture', $user->prefecture) == '青森県' ? 'selected' : '' }}>
                                                青森県</option>
                                            <option value="岩手県"
                                                {{ old('prefecture', $user->prefecture) == '岩手県' ? 'selected' : '' }}>
                                                岩手県</option>
                                            <option value="宮城県"
                                                {{ old('prefecture', $user->prefecture) == '宮城県' ? 'selected' : '' }}>
                                                宮城県</option>
                                            <option value="秋田県"
                                                {{ old('prefecture', $user->prefecture) == '秋田県' ? 'selected' : '' }}>
                                                秋田県</option>
                                            <option value="山形県"
                                                {{ old('prefecture', $user->prefecture) == '山形県' ? 'selected' : '' }}>
                                                山形県</option>
                                            <option value="福島県"
                                                {{ old('prefecture', $user->prefecture) == '福島県' ? 'selected' : '' }}>
                                                福島県</option>
                                        </optgroup>
                                        <optgroup label="---関東信越地区---">
                                            <option value="茨城県"
                                                {{ old('prefecture', $user->prefecture) == '茨城県' ? 'selected' : '' }}>
                                                茨城県</option>
                                            <option value="栃木県"
                                                {{ old('prefecture', $user->prefecture) == '栃木県' ? 'selected' : '' }}>
                                                栃木県</option>
                                            <option value="群馬県"
                                                {{ old('prefecture', $user->prefecture) == '群馬県' ? 'selected' : '' }}>
                                                群馬県</option>
                                            <option value="埼玉県"
                                                {{ old('prefecture', $user->prefecture) == '埼玉県' ? 'selected' : '' }}>
                                                埼玉県</option>
                                            <option value="千葉県"
                                                {{ old('prefecture', $user->prefecture) == '千葉県' ? 'selected' : '' }}>
                                                千葉県</option>
                                            <option value="東京都"
                                                {{ old('prefecture', $user->prefecture) == '東京都' ? 'selected' : '' }}>
                                                東京都</option>
                                            <option value="神奈川県"
                                                {{ old('prefecture', $user->prefecture) == '神奈川県' ? 'selected' : '' }}>
                                                神奈川県</option>
                                            <option value="山梨県"
                                                {{ old('prefecture', $user->prefecture) == '山梨県' ? 'selected' : '' }}>
                                                山梨県</option>
                                            <option value="長野県"
                                                {{ old('prefecture', $user->prefecture) == '長野県' ? 'selected' : '' }}>
                                                長野県</option>
                                            <option value="新潟県"
                                                {{ old('prefecture', $user->prefecture) == '新潟県' ? 'selected' : '' }}>
                                                新潟県</option>
                                        </optgroup>
                                        <optgroup label="---中部地区---">
                                            <option value="静岡県"
                                                {{ old('prefecture', $user->prefecture) == '静岡県' ? 'selected' : '' }}>
                                                静岡県</option>
                                            <option value="愛知県"
                                                {{ old('prefecture', $user->prefecture) == '愛知県' ? 'selected' : '' }}>
                                                愛知県</option>
                                            <option value="岐阜県"
                                                {{ old('prefecture', $user->prefecture) == '岐阜県' ? 'selected' : '' }}>
                                                岐阜県</option>
                                            <option value="三重県"
                                                {{ old('prefecture', $user->prefecture) == '三重県' ? 'selected' : '' }}>
                                                三重県</option>
                                        </optgroup>
                                        <optgroup label="---北陸地区---">
                                            <option value="富山県"
                                                {{ old('prefecture', $user->prefecture) == '富山県' ? 'selected' : '' }}>
                                                富山県</option>
                                            <option value="石川県"
                                                {{ old('prefecture', $user->prefecture) == '石川県' ? 'selected' : '' }}>
                                                石川県</option>
                                            <option value="福井県"
                                                {{ old('prefecture', $user->prefecture) == '福井県' ? 'selected' : '' }}>
                                                福井県</option>
                                        </optgroup>
                                        <optgroup label="---近畿地区---">
                                            <option value="滋賀県"
                                                {{ old('prefecture', $user->prefecture) == '滋賀県' ? 'selected' : '' }}>
                                                滋賀県</option>
                                            <option value="京都府"
                                                {{ old('prefecture', $user->prefecture) == '京都府' ? 'selected' : '' }}>
                                                京都府</option>
                                            <option value="大阪府"
                                                {{ old('prefecture', $user->prefecture) == '大阪府' ? 'selected' : '' }}>
                                                大阪府</option>
                                            <option value="兵庫県"
                                                {{ old('prefecture', $user->prefecture) == '兵庫県' ? 'selected' : '' }}>
                                                兵庫県</option>
                                            <option value="奈良県"
                                                {{ old('prefecture', $user->prefecture) == '奈良県' ? 'selected' : '' }}>
                                                奈良県</option>
                                            <option value="和歌山県"
                                                {{ old('prefecture', $user->prefecture) == '和歌山県' ? 'selected' : '' }}>
                                                和歌山県</option>
                                        </optgroup>
                                        <optgroup label="---中国地区---">
                                            <option value="鳥取県"
                                                {{ old('prefecture', $user->prefecture) == '鳥取県' ? 'selected' : '' }}>
                                                鳥取県</option>
                                            <option value="島根県"
                                                {{ old('prefecture', $user->prefecture) == '島根県' ? 'selected' : '' }}>
                                                島根県</option>
                                            <option value="岡山県"
                                                {{ old('prefecture', $user->prefecture) == '岡山県' ? 'selected' : '' }}>
                                                岡山県</option>
                                            <option value="広島県"
                                                {{ old('prefecture', $user->prefecture) == '広島県' ? 'selected' : '' }}>
                                                広島県</option>
                                            <option value="山口県"
                                                {{ old('prefecture', $user->prefecture) == '山口県' ? 'selected' : '' }}>
                                                山口県</option>
                                        </optgroup>
                                        <optgroup label="---四国地区---">
                                            <option value="徳島県"
                                                {{ old('prefecture', $user->prefecture) == '徳島県' ? 'selected' : '' }}>
                                                徳島県</option>
                                            <option value="香川県"
                                                {{ old('prefecture', $user->prefecture) == '香川県' ? 'selected' : '' }}>
                                                香川県</option>
                                            <option value="愛媛県"
                                                {{ old('prefecture', $user->prefecture) == '愛媛県' ? 'selected' : '' }}>
                                                愛媛県</option>
                                            <option value="高知県"
                                                {{ old('prefecture', $user->prefecture) == '高知県' ? 'selected' : '' }}>
                                                高知県</option>
                                        </optgroup>
                                        <optgroup label="---九州地区---">
                                            <option value="福岡県"
                                                {{ old('prefecture', $user->prefecture) == '福岡県' ? 'selected' : '' }}>
                                                福岡県</option>
                                            <option value="佐賀県"
                                                {{ old('prefecture', $user->prefecture) == '佐賀県' ? 'selected' : '' }}>
                                                佐賀県</option>
                                            <option value="長崎県"
                                                {{ old('prefecture', $user->prefecture) == '長崎県' ? 'selected' : '' }}>
                                                長崎県</option>
                                            <option value="熊本県"
                                                {{ old('prefecture', $user->prefecture) == '熊本県' ? 'selected' : '' }}>
                                                熊本県</option>
                                            <option value="大分県"
                                                {{ old('prefecture', $user->prefecture) == '大分県' ? 'selected' : '' }}>
                                                大分県</option>
                                            <option value="宮崎県"
                                                {{ old('prefecture', $user->prefecture) == '宮崎県' ? 'selected' : '' }}>
                                                宮崎県</option>
                                            <option value="鹿児島県"
                                                {{ old('prefecture', $user->prefecture) == '鹿児島県' ? 'selected' : '' }}>
                                                鹿児島県</option>
                                        </optgroup>
                                        <optgroup label="---沖縄---">
                                            <option value="沖縄県"
                                                {{ old('prefecture', $user->prefecture) == '沖縄県' ? 'selected' : '' }}>
                                                沖縄県</option>
                                        </optgroup>
                                        <optgroup label="---その他---">
                                            <option value="海外"
                                                {{ old('prefecture', $user->prefecture) == '海外' ? 'selected' : '' }}>海外
                                            </option>
                                        </optgroup>
                                    </x-select>
                                    <x-ajax-input-error id="error-prefecture" class="mt-2" />
                                    <x-input-error :messages="$errors->get('prefecture')" class="mt-2" />
                                </div>

                                <!-- Address 1 -->
                                <div id="container-address1" class="mb-4">
                                    <x-text.custom-input-label text="市区町村・番地" class="mb-2" option="必須" />
                                    <x-text-input id="address1" class="block mt-1 w-full" type="text"
                                        name="address1" :value="old('address1', $user->address1 ?? '')" required />
                                    <x-ajax-input-error id="error-address1" class="mt-2" />
                                    <x-input-error :messages="$errors->get('address1')" class="mt-2" />
                                </div>

                                <!-- Address 2 -->
                                <div id="container-address2" class="mb-4">
                                    <x-text.custom-input-label text="建物名など" class="mb-2" option="任意" />
                                    <x-text-input id="address2" class="block mt-1 w-full" type="text"
                                        name="address2" :value="old('name', $user->address2 ?? '')" />
                                    <x-ajax-input-error id="error-address2" class="mt-2" />
                                    <x-input-error :messages="$errors->get('address2')" class="mt-2" />
                                </div>

                                <div class="divide-y divide-red-400">
                                    <div class="mt-4">
                                        @include('auth.car-profile', ['no' => 1])
                                    </div>
                                    <div class="mt-4">
                                        @include('auth.car-profile', ['no' => 2])
                                    </div>
                                    <div class="mt-4">
                                        @include('auth.car-profile', ['no' => 3])
                                    </div>
                                </div>

                                <!-- Newsletter Subscription -->
                                <div id="container-is_receive_newsletter" class="mb-4">
                                    <x-text.custom-input-label text="メルマガ配信" class="mb-2" option="任意" />
                                    <div class="flex flex-col gap-2 justify-center items-start">
                                        @foreach (array_reverse(\App\Enums\IsNewsletterEnum::cases()) as $newsletterOption)
                                            <div class="my-1 flex items-center gap-3">
                                                <x-text-input
                                                    id="is_receive_newsletter-{{ $newsletterOption->value }}"
                                                    type="radio" name="is_receive_newsletter" :value="$newsletterOption->value"
                                                    :checked="old(
                                                        'is_receive_newsletter',
                                                        $user->is_receive_newsletter?->value,
                                                    ) == $newsletterOption->value" />
                                                <x-input-label
                                                    for="is_receive_newsletter-{{ $newsletterOption->value }}"
                                                    :value="__($newsletterOption->getLabel())" />
                                            </div>
                                        @endforeach
                                    </div>
                                    <x-ajax-input-error id="error-is_receive_newsletter" class="mt-2" />
                                    <x-input-error :messages="$errors->get('is_receive_newsletter')" class="mt-2" />
                                </div>

                                <!-- How did you hear -->
                                <div id="container-questionnaire" class="mb-4">
                                    <x-text.custom-input-label text="【アンケート】弊社の車検を何でお知りになりましたか" class="mb-2"
                                        option="必須" />
                                    @foreach ($questionnaire as $anket)
                                        <div class="mt-4 flex items-center gap-3 mb-3">
                                            <x-text-input id="anket-{{ $anket->id }}" type="checkbox"
                                                name="questionnaire[]" :value="$anket->id" :checked="in_array(
                                                    $anket->id,
                                                    old('questionnaire', $user->questionnaire ?? []),
                                                )" />
                                            <x-input-label for="anket-{{ $anket->id }}" :value="$anket->name" />
                                        </div>
                                    @endforeach
                                    <x-ajax-input-error id="error-questionnaire" class="mt-2" />
                                    <x-input-error :messages="$errors->get('questionnaire')" class="mt-2" />
                                </div>

                                <!-- Manager・担当者 -->
                                <div id="container-manager" class="mb-4">
                                    <x-text.custom-input-label text="担当者" class="mb-2" option="任意" />
                                    <x-text-input id="manager" class="block mt-1 w-full" type="text"
                                        name="manager" :value="old('manager', $user->manager ?? '')" />
                                    <x-text.custom-input-label text="リースメンテナンス契約のある法人様のみご入力ください。"
                                        spanClass="font-normal text-xs text-gray-500 mt-1" />
                                    <x-ajax-input-error id="error-manager" class="mt-2" />
                                    <x-input-error :messages="$errors->get('manager')" class="mt-2" />
                                </div>

                                <!-- Department・ -->
                                <div id="container-department" class="mb-4">
                                    <x-text.custom-input-label text="部署名／支店名" class="mb-2" option="任意" />
                                    <x-text-input id="department" class="block mt-1 w-full" type="text"
                                        name="department" :value="old('department', $user->department ?? '')" />
                                    <x-ajax-input-error id="error-department" class="mt-2" />
                                    <x-input-error :messages="$errors->get('department')" class="mt-2" />
                                </div>

                                <!-- Notification Subscription -->
                                <div id="container-is_receive_notification" class="mb-4">
                                    <x-text.custom-input-label text="店からのお知らせメール" class="mb-2" option="必須" />
                                    <div class="flex flex-col gap-2 justify-center items-start">
                                        @foreach (array_reverse(\App\Enums\IsNotificationEnum::cases()) as $notificationOption)
                                            <div class="my-1 flex items-center gap-3">
                                                <x-text-input
                                                    id="is_receive_notification-{{ $notificationOption->value }}"
                                                    type="radio" name="is_receive_notification" :value="$notificationOption->value"
                                                    :checked="old(
                                                        'is_receive_notification',
                                                        $user->is_receive_notification->value,
                                                    ) == $notificationOption->value" />
                                                <x-input-label
                                                    for="is_receive_notification-{{ $notificationOption->value }}"
                                                    :value="__($notificationOption->getLabel())" />
                                            </div>
                                        @endforeach
                                    </div>
                                    <x-ajax-input-error id="error-is_receive_notification" class="mt-2" />
                                    <x-input-error :messages="$errors->get('is_receive_notification')" class="mt-2" />
                                </div>

                                <!-- remarks -->
                                <div id="container-remarks" class="mb-4">
                                    <x-text.custom-input-label text="管理用備考" class="mb-2" option="任意" />
                                    <x-textarea id="remarks" class="block mt-1 w-full" name="remarks"
                                        :value="old('remarks', $user->remarks ?? '')" />
                                    <x-ajax-input-error id="error-admin_notes" class="mt-2" />
                                    <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                                </div>

                                <!-- 更新ボタン -->
                                <div class="mb-4 flex justify-end">
                                    <!-- 更新ボタン -->
                                    <x-primary-button class="ms-3">更新</x-primary-button>
                                </div>
                            </form>

                            <!-- 削除ボタン -->
                            <form action="{{ route('admin.userList.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <div class="mb-4 flex justify-end">
                                    <button type="submit"
                                        class="ms-3 bg-red-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-800 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        削除
                                    </button>
                                </div>
                            </form>

                            <!-- 前の画面に戻るボタン -->
                            <div class="mb-4 flex justify-end">
                                <button onclick="window.history.back()"
                                    class="ms-3 bg-gray-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    前の画面に戻る
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</x-admin-app-layout>
