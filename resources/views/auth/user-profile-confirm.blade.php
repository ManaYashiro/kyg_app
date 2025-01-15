<x-text.custom-text text="会員登録確認" class="mb-3 bottom-border-text font-bold" />
<div class="mt-3 flex flex-col gap-1">
    <x-text.custom-text text="以下の内容を確認してください。" class="text-xs" />
</div>

<x-text.custom-text text="ログイン情報" class="mt-6 mb-2 bg-gray-text" />
<!-- Login ID -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="ログインID" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-loginid" class="mb-6" />
</div>

<!-- Password -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="パスワード" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-password" class="mb-6" />
</div>

<x-text.custom-text text="基本情報" class="mt-6 mb-2 bg-gray-text" />

<!-- Person Type -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="法人／個人" class="mb-2 left-border-text" />
    @foreach (\App\Enums\PersonTypeEnum::cases() as $person_type)
        <x-text.custom-text :text="$person_type->getLabel()" id="confirm-person_type-{{ $person_type->value }}"
            class="mb-6 hidden isOption" />
    @endforeach
</div>

<!-- Name -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="顧客名" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-name" class="mb-6" />
</div>

<!-- Name Furigana -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="フリガナ" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-name_furigana" class="mb-6" />
</div>

<!-- Email Address -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="メールアドレス" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-email" class="mb-6" />
</div>

<!-- Phone Number -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="電話番号" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-phone_number" class="mb-6" />
</div>

<!-- Gender -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="性別" class="mb-2 left-border-text" />
    @foreach (\App\Enums\GenderEnum::cases() as $gender)
        <x-text.custom-text :text="$gender->getLabel()" id="confirm-gender-{{ $gender->value }}" class="mb-6 hidden isOption" />
    @endforeach
</div>

<!-- Birthday -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="生年月日" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-birthday" class="mb-6" />
</div>

<!-- Preferred Time -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="電話連絡の希望時間帯" class="mb-2 left-border-text" />
    @foreach (\App\Enums\CallTimeEnum::cases() as $callTime)
        <x-text.custom-text :text="$callTime->getLabel()" id="confirm-call_time-{{ $callTime->value }}"
            class="mb-6 hidden isOption" />
    @endforeach
</div>

<!-- Postal Code -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="郵便番号" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-zipcode" class="mb-6" />
</div>

<!-- Prefecture -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="都道府県" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-prefecture" class="mb-6" />
</div>

<!-- Address 1 -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="市区町村・番地" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-address1" class="mb-6" />
</div>

<!-- Address 2 -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="建物名など" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-address2" class="mb-6" />
</div>

@include('auth.car-profile-confirm', ['sequence_no' => 1])
@include('auth.car-profile-confirm', ['sequence_no' => 2])
@include('auth.car-profile-confirm', ['sequence_no' => 3])

<!-- Newsletter Subscription -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="メルマガ配信" class="mb-2 left-border-text" />
    @foreach (array_reverse(\App\Enums\IsNewsletterEnum::cases()) as $newsletterOption)
        <x-text.custom-text :text="$newsletterOption->getLabel()" id="confirm-is_receive_newsletter-{{ $newsletterOption->value }}"
            class="mb-6 hidden isOption" />
    @endforeach
</div>

<!-- How did you hear -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="【アンケート】弊社の車検を何でお知りになりましたか" class="mb-2 left-border-text" />
    @php
        $questionList = [];
    @endphp
    @foreach (\App\Enums\QuestionnaireEnum::cases() as $question)
        @php
            array_push($questionList, ['id' => $loop->index + 1, 'name' => $question->value]);
        @endphp
    @endforeach
    <input type="hidden" id="confirm-questionnaire-list"
        data-list="{{ json_encode($questionList, JSON_PRETTY_PRINT) }}">
    <x-text.custom-text :text="''" id="confirm-questionnaire" class="mb-6 w-full overflow-hidden"
        textClass="block break-words" />
</div>

<!-- Manager・担当者 -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="担当者" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-manager" class="mb-6" />
</div>

<!-- Department・ -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="部署名／支店名" class="mb-2 left-border-text" />
    <x-text.custom-text :text="''" id="confirm-department" class="mb-6" />
</div>

<!-- Notification Subscription -->
<div class="isConfirm mt-4 hidden">
    <x-text.custom-input-label text="店からのお知らせメール" class="mb-2 left-border-text" />
    @foreach (array_reverse(\App\Enums\IsNotificationEnum::cases()) as $notificationOption)
        <x-text.custom-text :text="$notificationOption->getLabel()" id="confirm-is_receive_notification-{{ $notificationOption->value }}"
            class="mb-6 hidden isOption" />
    @endforeach
</div>
