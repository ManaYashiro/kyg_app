<x-text.custom-text text="会員登録" class="mb-3 bottom-border-text font-bold" />
<div class="mt-3 flex flex-col gap-1">
    <x-text.custom-text text="以下の内容を確認してください。" class="text-xs" />
</div>

<x-text.custom-text text="ログイン情報" class="mt-6 mb-2 bg-gray-text" />
<!-- Login ID -->
<div class="mt-4">
    <x-text.custom-input-label text="ログインID" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'loginid'" id="confirm-loginid" class="mb-6" />
</div>

<!-- Password -->
<div class="mt-4">
    <x-text.custom-input-label text="パスワード" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'password'" id="confirm-password" class="mb-6" />
</div>

<x-text.custom-text text="基本情報" class="mt-6 mb-2 bg-gray-text" />
<!-- Name -->
<div class="mt-4">
    <x-text.custom-input-label text="顧客名" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'name'" id="confirm-name" class="mb-6" />
</div>

<!-- Name Furigana -->
<div class="mt-4">
    <x-text.custom-input-label text="フリガナ" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'name_furigana'" id="confirm-name_furigana" class="mb-6" />
</div>

<!-- Email Address -->
<div class="mt-4">
    <x-text.custom-input-label text="メールアドレス" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'email'" id="confirm-email" class="mb-6" />
</div>

<!-- Phone Number -->
<div class="mt-4">
    <x-text.custom-input-label text="電話番号" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'phone_number'" id="confirm-phone_number" class="mb-6" />
</div>

<!-- Gender -->
<div class="mt-4">
    <x-text.custom-input-label text="性別" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'gender'" id="confirm-gender" class="mb-6" />
</div>

<!-- Birthday -->
<div class="mt-4">
    <x-text.custom-input-label text="生年月日" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'birthday'" id="confirm-birthday" class="mb-6" />
</div>

<!-- Preferred Time -->
<div class="mt-4">
    <x-text.custom-input-label text="電話希望時間" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'call_time'" id="confirm-call_time" class="mb-6" />
</div>

<!-- Postal Code -->
<div class="mt-4">
    <x-text.custom-input-label text="郵便番号" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'zipcode'" id="confirm-zipcode" class="mb-6" />
</div>

<div class="mt-4">
    <x-text.custom-input-label text="都道府県" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'prefecture'" id="confirm-prefecture" class="mb-6" />
</div>

<!-- Address 1 -->
<div class="mt-4">
    <x-text.custom-input-label text="市区町村・番地" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'address1'" id="confirm-address1" class="mb-6" />
</div>

<!-- Address 2 -->
<div class="mt-4">
    <x-text.custom-input-label text="建物名など" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'address2'" id="confirm-address2" class="mb-6" />
</div>

@include('auth.car-profile')

<!-- Newsletter Subscription -->
<div class="mt-4">
    <x-text.custom-input-label text="メルマガ配信" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'is_receive_newsletter'" id="confirm-is_receive_newsletter" class="mb-6" />
</div>

<!-- How did you hear -->
<div class="mt-4">
    <x-text.custom-input-label text="【アンケート】弊社の車検を何でお知りになりましたか" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'anket'" id="confirm-anket" class="mb-6" />
</div>

<!-- Manager・担当者 -->
<div class="mt-4">
    <x-text.custom-input-label text="担当者" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'manager'" id="confirm-manager" class="mb-6" />
</div>

<!-- Department・ -->
<div class="mt-4">
    <x-text.custom-input-label text="部署名／支店名" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'department'" id="confirm-department" class="mb-6" />
</div>

<!-- Notification Subscription -->
<div class="mt-4">
    <x-text.custom-input-label text="店からのお知らせメール" class="mb-2 left-border-text" />
    <x-text.custom-text :text="'is_receive_notification'" id="confirm-is_receive_notification" class="mb-6" />
</div>
