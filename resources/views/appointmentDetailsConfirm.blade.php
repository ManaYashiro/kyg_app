<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="h-full overflow-y-auto p-6 text-gray-900">

        <div class="mb-3 bottom-border-text font-bold">
            <span class="">予約情報確認</span>
        </div>

        <h2 class="text-sm font-semibold">予約詳細</h2>
        <div class="container mx-auto p-4">

            @if (session('success'))
                <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('appointmentDetails.store') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $appointment['id'] }}" />
            <!-- 予約番号 -->
            <div class="mb-4">
                <x-input-label for="reservation_number" :value="__('予約番号')" />
                <x-data-display :value="$appointment['reservation_number']" />
            </div>

            <!-- 予約日時 -->
            <div class="mb-4">
                <x-input-label for="reservation_datetime" :value="__('予約日時')" />
                <x-data-display :value="$appointment['reservation_datetime']" />
            </div>

            <!-- 希望店舗 -->
            <div class="mb-4">
                <x-input-label for="store" :value="__('希望店舗')" />
                <x-data-display :value="$appointment['store']" />
            </div>

            <!-- 作業カテゴリ -->
            <div class="mb-4">
                <x-input-label for="inspection_type" :value="__('作業カテゴリ')" />
                <x-data-display :value="$appointment['inspection_type']" />
            </div>

            <!-- 作業種別 -->
            <div class="mb-4">
                <x-input-label for="work_type" :value="__('作業種別')" />
                <x-data-display :value="$appointment['work_type']" />
            </div>

            <!-- 個人・法人 -->
            <div class="mb-4">
                <x-input-label for="customer_type" :value="__('個人・法人')" />
                <x-data-display :value="$appointment['customer_type']" />
            </div>

            <!-- 予約する作業 -->
            <div class="mb-4">
                <x-input-label for="reservation_task_id" :value="__('予約する作業')" />
                <x-data-display :value="$appointment['reservation_task_id']" />
            </div>

            <!-- 車両 -->
            <div class="mb-4">
                <x-text.custom-input-label text="【車両選択】複数お車をご登録されている方は、何台目に登録されているお車か選択してください。" class="mb-2"/>
                <x-data-display :value="$appointment['user_vehicle_id'] == 4 ? '未登録車' : $appointment['user_vehicle_id'] . '台目'" />
                <input type="hidden" name="user_vehicle_id" value="{{ $appointment['user_vehicle_id'] }}" />
            </div>

            <!-- 追加整備 -->
            <div class="mt-4">
                <h5>
                    <x-text.custom-input-label text="【追加整備】本作業とあわせて追加作業を依頼したい場合にお選びください。" class="mb-2"/>
                    @if(!empty($appointment['additional_services']))
                        @php
                            // 配列の場合は文字列に変換
                            $services = is_array($appointment['additional_services'])
                                ? implode(', ', $appointment['additional_services'])
                                : $appointment['additional_services'];
                        @endphp
                        @foreach(explode(', ', $services) as $service)
                            <x-data-display :value="$service" /><br>
                        @endforeach
                        <input type="hidden" name="additional_services" value="{{ $services }}" />
                    @endif
                </h5>
            </div>

            <!-- 車検満期日 -->
            <div class="mt-4">
                <h5>
                    <x-text.custom-input-label text="車検満期日をご入力ください。" class="mb-2"/>
                    <x-data-display :value="\Carbon\Carbon::parse($appointment['inspection_due_date'])->format('Y/m/d')" />
                    <input type="hidden" name="inspection_due_date" value="{{ $appointment['inspection_due_date'] }}" />
                </h5>
            </div>

            <!-- 過去利用履歴 -->
            <div class="mt-4">
                <h5>
                    <x-text.custom-input-label text="今回ご予約いただく店舗・作業は、過去にご利用がございますか？" class="mb-2"/>
                    <x-data-display :value="$appointment['past_service_history']" />
                    <input type="hidden" name="past_service_history" value="{{ $appointment['past_service_history'] }}" />
                </h5>
            </div>
            <div class="flex flex-row items-center justify-center gap-14 mt-8">
                <div class="w-1/3">
                    <button id="button-prev" class="bg-gray-200 text-black rounded w-full px-4 py-4" type="button" onclick="window.history.back()">
                        前の画面に戻る
                    </button>
                </div>
                <div class="w-1/3 block">
                    <button id="button-next" class="bg-red-1000 text-white rounded w-full px-4 py-4" type="submit">
                        登録する
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
</x-app-layout>
