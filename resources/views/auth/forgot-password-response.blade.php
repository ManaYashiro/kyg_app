<x-guest-layout>
    <div class="max-w-full bg-success-response">
        <span>メールアドレスにパスワード再設定用のURLを発行しました。</span>
        <span>2時間以内にアクセスし、新しいパスワードを設定してください。</span>
    </div>

    <div class="max-w-lg mt-6 py-8 mx-auto">
        <div class="flex flex-col items-end justify-center gap-10 mt-4">
            <x-buttons.actionbutton name="{{ __('ホームヘ') }}" type="button" url="{{ route('top') }}" class="px-4 py-4" />
        </div>
    </div>
</x-guest-layout>
