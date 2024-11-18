<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>予約内容確認</h2>

                    <form method="POST" action="{{ route('appointments.store') }}">
                        @csrf

                        <div class="mt-6">
                            <h3 class="text-xl font-semibold text-gray-800">予約番号</h3>
                            <p class="text-gray-600">{{ $vehicles[0]['appoint_number'] }}</p>
                            <input type="hidden" name="appoint_number" value="{{ $vehicles[0]['appoint_number'] }}">
                        </div>

                        <div class="mt-6">
                            <h3 class="text-xl font-semibold text-gray-800">予約日時</h3>
                            <p class="text-gray-600">{{ $vehicles[0]['reservation_datetime'] }}</p>
                            <input type="hidden" name="reservation_datetime"
                                value="{{ $vehicles[0]['reservation_datetime'] }}">
                        </div>

                        <!-- 車両情報 -->
                        @foreach ($vehicles as $vehicle)
                            <div class="mt-6 p-4 bg-gray-50 rounded-lg shadow">
                                <h4 class="text-lg font-medium text-gray-800">車両 {{ $vehicle['sort_number'] }}</h4>
                                <div class="space-y-2">
                                    <p><strong class="font-medium">車両名:</strong> {{ $vehicle['vehicle_name'] }}</p>
                                    <input type="hidden" name="vehicle_name[]" value="{{ $vehicle['vehicle_name'] }}">
                                    <p><strong class="font-medium">登録番号:</strong> {{ $vehicle['registration_number'] }}
                                    </p>
                                    <input type="hidden" name="registration_number[]"
                                        value="{{ $vehicle['registration_number'] }}">
                                    <p><strong class="font-medium">車両タイプ:</strong> {{ $vehicle['vehicle_type'] }}</p>
                                    <input type="hidden" name="vehicle_type[]" value="{{ $vehicle['vehicle_type'] }}">
                                    <p><strong class="font-medium">車検満了日:</strong>
                                        {{ $vehicle['inspection_due_date'] }}</p>
                                    <input type="hidden" name="inspection_due_date[]"
                                        value="{{ $vehicle['inspection_due_date'] }}">
                                    <p><strong class="font-medium">追加装備:</strong>
                                        {{ $vehicle['additional_services'] ?? 'なし' }}</p>
                                    <input type="hidden" name="additional_services[]"
                                        value="{{ $vehicle['additional_services'] ?? '' }}">
                                </div>
                            </div>
                        @endforeach

                        <!-- 過去利用履歴 -->
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-800">過去利用履歴</h3>
                            <p class="text-gray-600">{{ $vehicles[0]['past_service_history'] }}</p>
                            <input type="hidden" name="past_service_history"
                                value="{{ $vehicles[0]['past_service_history'] }}">
                        </div>

                        <!-- メッセージ -->
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-800">メッセージ</h3>
                            <p class="text-gray-600">{{ $vehicles[0]['message'] }}</p>
                            <input type="hidden" name="message" value="{{ $vehicles[0]['message'] }}">
                        </div>

                        <!-- 確定ボタン -->
                        <div class="mt-6">
                            <x-primary-button class="ml-4" type="submit">
                                {{ __('予約を確定') }}
                            </x-primary-button>
                        </div>
                    </form>
                    <a href="{{ route('appointments.index') }}" class="text-blue-600">戻る</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
