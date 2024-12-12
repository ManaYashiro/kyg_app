<input id="form-type" type="hidden" name="form_type" value="{{ $formType }}">
<input id="submit-type" type="hidden" name="submit_type" value="{{ $submitType }}">
<x-text.custom-text text="会員登録" class="mb-3 bottom-border-text font-bold" />
<div class="mt-3 flex flex-col gap-1">
    <x-text.custom-text text="各項目をご入力の上、[次へ進む] ボタンをクリックしてください。" class="text-xs" />
    <x-text.custom-text text="会員登録後、ご入力いただいたメールアドレス宛に会員登録完了の" class="text-xs" />
    <x-text.custom-text text="メールが自動配信されます。" class="text-xs" />
    <x-text.custom-text text="※24時間経過してもメールが配信されない場合は、右上メニュー内にある「よくある質問」からQ3をご確認ください。" class="text-xs text-red-500" />
</div>

<x-text.custom-text text="ログイン情報" class="mt-6 mb-2 bg-gray-text" />
<!-- Login ID -->
<div id="container-loginid" class="mt-4">
    <x-text.custom-input-label text="ログインID" class="mb-2" option="必須" />
    <x-text-input id="loginid" class="block mt-1 w-full" type="text" name="loginid" :value="old('loginid') ?? $user ? $user->loginid : null" required
        autofocus />
    <x-text.custom-input-label text="※半角英数字 4文字以上で入力してください。" spanClass="font-normal text-xs text-gray-500 mt-1" />
    <x-ajax-input-error id="error-loginid" class="mt-2" />
    <x-input-error :messages="$errors->get('loginid')" class="mt-2" />
</div>

<!-- Password -->
<div id="container-password" class="mt-4">
    <x-text.custom-input-label text="パスワード" class="mb-2" option="必須" />
    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
    <x-text.custom-input-label text="※半角英数字 4～20文字で入力してください。" spanClass="font-normal text-xs text-gray-500 mt-1" />
    <x-ajax-input-error id="error-password" class="mt-2" />
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Confirm Password -->
<div id="container-password_confirmation" class="mt-4">
    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
        required />
    <x-text.custom-input-label text="※確認のためにもう一度パスワードを入力してください。" spanClass="font-normal text-xs text-gray-500 mt-1" />
    <x-ajax-input-error id="error-password_confirmation" class="mt-2" />
    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

<x-text.custom-text text="基本情報" class="mt-6 mb-2 bg-gray-text" />
<!-- Name -->
<div id="container-name" class="mt-4">
    <x-text.custom-input-label text="顧客名" class="mb-2" option="必須" />
    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $user ? $user->name : null" required />
    <x-ajax-input-error id="error-name" class="mt-2" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- Name Furigana -->
<div id="container-name_furigana" class="mt-4">
    <x-text.custom-input-label text="フリガナ" class="mb-2" option="必須" />
    <x-text-input id="name_furigana" class="block mt-1 w-full" type="text" name="name_furigana" :value="old('name_furigana') ?? $user ? $user->name_furigana : null"
        required />
    <x-ajax-input-error id="error-name_furigana" class="mt-2" />
    <x-input-error :messages="$errors->get('name_furigana')" class="mt-2" />
</div>

<!-- Birthday -->
<div id="container-birthday" class="mt-4">
    <x-text.custom-input-label text="生年月日" class="mb-2" option="必須" />
    <x-text-input id="birthday" type="text" name="birthday" :value="old('birthday') ?? $user ? $user->birthday : null"
        class="datepicker block mt-1 w-full md:w-1/4" required />
    <x-ajax-input-error id="error-birthday" class="mt-2" />
    <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
</div>

<!-- Gender -->
{{-- $user->gender->value since User Model `casts` gender is using ENUM --}}
<div id="container-gender" class="mt-4">
    <x-text.custom-input-label text="性別" class="mb-2" option="任意" />
    <div class="flex flex-col gap-2 justify-center items-start">
        @foreach (\App\Enums\GenderEnum::cases() as $gender)
            <div class="my-1 flex items-center gap-3">
                <x-text-input id="gender-{{ $gender->value }}" type="radio" name="gender" :value="$gender->value"
                    :checked="(old('gender') ?? $user ? $user->gender->value : null) === $gender->value" />
                <x-input-label for="gender" :value="__($gender->getLabel())" />
            </div>
        @endforeach
    </div>
    <x-ajax-input-error id="error-gender" class="mt-2" />
    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
</div>

<!-- Email Address -->
<div id="container-email" class="mt-4">
    <x-text.custom-input-label text="メールアドレス" class="mb-2" option="必須" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email') ?? $user ? $user->email : null"
        required />
    <x-text.custom-input-label text="PCまたは携帯のアドレスをご入力ください。" spanClass="font-normal text-xs text-gray-500 mt-1" />
    <x-text.custom-input-label text="※1つのメールアドレスで3台のお車まで登録いただけます。4台目のお車の追加をご希望の方は、新しいメールアドレスでご登録ください。"
        spanClass="font-normal text-xs text-gray-500 mt-1" />
    <x-ajax-input-error id="error-email" class="mt-2" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Phone Number -->
<div id="container-phone_number" class="mt-4">
    <x-text.custom-input-label text="電話番号" class="mb-2" option="必須" />
    <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number') ?? $user ? $user->phone_number : null"
        required />
    <x-text.custom-input-label text="※- （ハイフン）なしで記入　11桁以内" spanClass="font-normal text-xs text-gray-500 mt-1" />
    <x-text.custom-input-label text="※自宅または携帯の番号をご入力下さい。" spanClass="font-normal text-xs text-gray-500 mt-1" />
    <x-ajax-input-error id="error-phone_number" class="mt-2" />
    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
</div>

<!-- Preferred Time -->
<div id="container-call_time" class="mt-4">
    <x-text.custom-input-label text="電話希望時間" class="mb-2" option="必須" />
    @foreach (\App\Enums\CallTimeEnum::cases() as $callTime)
        <div class="mt-4 flex items-center gap-3 mb-3">
            <x-text-input id="contact-time-{{ $callTime->value }}" type="radio" name="call_time" :value="$callTime->value"
                :checked="(old('call_time') ?? $user ? $user->call_time : null) === $callTime->value" />
            <x-input-label for="contact-time-{{ $callTime->value }}" :value="__($callTime->getLabel())" />
        </div>
    @endforeach
    <x-text.custom-input-label text="電話連絡時のご希望時間帯を選択してください。" spanClass="font-normal text-xs text-gray-500 mt-1" />
    <x-text.custom-input-label text="ご希望の時間帯にご連絡差し上げるよう努めてまいりますが、場合によってはご希望に添えない場合もございます。予めご了承いただけますようお願いいたします。"
        spanClass="font-normal text-xs text-gray-500 mt-1" />
    <x-ajax-input-error id="error-call_time" class="mt-2" />
    <x-input-error :messages="$errors->get('call_time')" class="mt-2" />
</div>

<!-- Postal Code -->
<div id="container-zipcode" class="mt-4">
    <x-text.custom-input-label text="郵便番号" class="mb-2" option="必須" />
    <div class="flex items-center space-x-2">
        <x-text-input id="zipcode" class="block mt-1 flex-1" type="text" name="zipcode" :value="old('zipcode') ?? $user ? $user->zipcode : null"
            required />

        <!-- 検索ボタン -->
        <button type="button" id="search-postcode"
            class="px-4 py-3 bg-blue-500 text-white rounded-md font-semibold text-xs hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
            検索
        </button>
    </div>
    <x-text.custom-input-label text="※- （ハイフン）なしで記入　7桁" spanClass="font-normal text-xs text-gray-500 mt-1" />
    <x-ajax-input-error id="error-zipcode" class="mt-2" />
    <x-input-error :messages="$errors->get('zipcode')" class="mt-2" />
</div>

<!-- Prefecture -->
@php
    $selected = old('prefecture') ?? ($user ? $user->prefecture : null);
@endphp
<div id="container-prefecture" class="mt-4">
    <x-text.custom-input-label text="都道府県" class="mb-2" option="必須" />
    <select name="prefecture" id="prefecture" name="prefecture" class="block mt-1 w-full md:w-1/4">
        <option value="">都道府県を選択</option>
        @foreach (\App\Enums\PrefectureEnum::getRegions() as $region => $prefectures)
            <optgroup label="{{ $region }}">
                @foreach ($prefectures as $prefecture)
                    <option {{ $selected == $prefecture ? 'selected="selected"' : '' }} value="{{ $prefecture }}">
                        {{ $prefecture }}
                    </option>
                @endforeach
        @endforeach
    </select>
    <x-ajax-input-error id="error-prefecture" class="mt-2" />
    <x-input-error :messages="$errors->get('prefecture')" class="mt-2" />
</div>

<!-- Address 1 -->
<div id="container-address1" class="mt-4">
    <x-text.custom-input-label text="市区町村・番地" class="mb-2" option="必須" />
    <x-text-input id="address1" class="block mt-1 w-full" type="text" name="address1" :value="old('address1') ?? $user ? $user->address1 : null"
        required />
    <x-ajax-input-error id="error-address1" class="mt-2" />
    <x-input-error :messages="$errors->get('address1')" class="mt-2" />
</div>

<!-- Address 2 -->
<div id="container-address2" class="mt-4">
    <x-text.custom-input-label text="建物名など" class="mb-2" option="任意" />
    <x-text-input id="address2" class="block mt-1 w-full" type="text" name="address2" :value="old('address2') ?? $user ? $user->address2 : null" />
    <x-ajax-input-error id="error-address2" class="mt-2" />
    <x-input-error :messages="$errors->get('address2')" class="mt-2" />
</div>

<div class="divide-y divide-red-400">
    <div class="mt-4">
        @include('auth.car-profile', ['no' => 1, 'userVehicles' => $user ? $user->userVehicles[0] : null])
    </div>
    <div class="mt-4">
        @include('auth.car-profile', ['no' => 2, 'userVehicles' => $user ? $user->userVehicles[0] : null])
    </div>
    <div class="mt-4">
        @include('auth.car-profile', ['no' => 3, 'userVehicles' => $user ? $user->userVehicles[0] : null])
    </div>
</div>

<!-- Newsletter Subscription -->
{{-- $user->is_receive_newsletter->value since User Model `casts` is_receive_newsletter is using ENUM --}}
<div id="container-is_receive_newsletter" class="mt-4">
    <x-text.custom-input-label text="メルマガ配信" class="mb-2" option="任意" />
    <div class="flex flex-col gap-2 justify-center items-start">
        @foreach (array_reverse(\App\Enums\IsNewsletterEnum::cases()) as $newsletterOption)
            <div class="my-1 flex items-center gap-3">
                <x-text-input id="is_receive_newsletter-{{ $newsletterOption->value }}" type="radio"
                    name="is_receive_newsletter" :value="$newsletterOption->value" :checked="(old('is_receive_newsletter') ?? $user ? $user->is_receive_newsletter->value : null) ===
                        $newsletterOption->value" />
                <x-input-label for="is_receive_newsletter-{{ $newsletterOption->value }}" :value="__($newsletterOption->getLabel())" />
            </div>
        @endforeach
    </div>
    <x-ajax-input-error id="error-is_receive_newsletter" class="mt-2" />
    <x-input-error :messages="$errors->get('is_receive_newsletter')" class="mt-2" />
</div>

<!-- How did you hear -->
<div id="container-questionnaire" class="mt-4">
    <x-text.custom-input-label text="【アンケート】弊社の車検を何でお知りになりましたか（複数回答3つまで）" class="mb-2" option="必須" />
    @foreach ($questionnaire as $anket)
        <div class="mt-4 flex items-center gap-3 mb-3">
            <x-text-input id="anket-{{ $anket->id }}" type="checkbox" name="questionnaire[]" :value="$anket->id"
                :checked="in_array($anket->id, old('questionnaire') ?? $user ? $user->questionnaire : [])" />
            <x-input-label for="anket-{{ $anket->id }}" :value="$anket->name" />
        </div>
    @endforeach
    <x-ajax-input-error id="error-questionnaire" class="mt-2" />
    <x-input-error :messages="$errors->get('questionnaire')" class="mt-2" />
</div>

<!-- Manager・担当者 -->
<div id="container-manager" class="mt-4">
    <x-text.custom-input-label text="担当者" class="mb-2" option="任意" />
    <x-text-input id="manager" class="block mt-1 w-full" type="text" name="manager" :value="old('manager') ?? $user ? $user->manager : null" />
    <x-text.custom-input-label text="リースメンテナンス契約のある法人様のみご入力ください。"
        spanClass="font-normal text-xs text-gray-500 mt-1" />
    <x-ajax-input-error id="error-manager" class="mt-2" />
    <x-input-error :messages="$errors->get('manager')" class="mt-2" />
</div>

<!-- Department・ -->
<div id="container-department" class="mt-4">
    <x-text.custom-input-label text="部署名／支店名" class="mb-2" option="任意" />
    <x-text-input id="department" class="block mt-1 w-full" type="text" name="department" :value="old('department') ?? $user ? $user->department : null" />
    <x-ajax-input-error id="error-department" class="mt-2" />
    <x-input-error :messages="$errors->get('department')" class="mt-2" />
</div>

<!-- Notification Subscription -->
{{-- $user->is_receive_notification->value since User Model `casts` is_receive_notification is using ENUM --}}
<div id="container-is_receive_notification" class="mt-4">
    <x-text.custom-input-label text="店からのお知らせメール" class="mb-2" option="必須" />
    <div class="flex flex-col gap-2 justify-center items-start">
        @foreach (array_reverse(\App\Enums\IsNotificationEnum::cases()) as $notificationOption)
            <div class="my-1 flex items-center gap-3">
                <x-text-input id="is_receive_notification-{{ $notificationOption->value }}" type="radio"
                    name="is_receive_notification" :value="$notificationOption->value" :checked="(old('is_receive_notification') ?? $user
                        ? $user->is_receive_notification->value
                        : null) === $notificationOption->value" />
                <x-input-label for="is_receive_notification-{{ $notificationOption->value }}" :value="__($notificationOption->getLabel())" />
            </div>
        @endforeach
    </div>
    <x-ajax-input-error id="error-is_receive_notification" class="mt-2" />
    <x-input-error :messages="$errors->get('is_receive_notification')" class="mt-2" />
</div>
