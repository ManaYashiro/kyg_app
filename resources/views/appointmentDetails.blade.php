<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="h-full overflow-y-auto p-6 text-gray-900">
        <div class="container mx-auto p-4">
            <h2 class="text-xl font-semibold mb-4">予約詳細</h2>

            @if (session('success'))
                <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                    {{ session('success') }}
                </div>
            @endif

            @foreach ($groupedAppointment as $appointNumber => $appointments)
                <!-- 予約番号 -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('予約番号')" />
                    <x-data-display :value="$appointNumber ?? ''" />
                </div>

                <!-- 予約日時 -->
                <div class="mb-4">
                    <x-input-label for="reservation_datetime" :value="__('予約日時')" />
                    <x-data-display :value="$appointments->first()->reservation_datetime ?? ''" />
                </div>

                <!-- 台数 -->
                <div class="mb-4">
                    <x-input-label for="sort_number" :value="__('台数')" />
                    <x-data-display :value="$appointments->max('sort_number') ?? ''" />
                </div>
            @endforeach
            @foreach ($appointment as $appointment_detail)
                <!-- ソート番号 -->
                <div class="mb-4">
                    <x-input-label for="sort_number" :value="__('台数')" />
                    <x-data-display :value="$appointment_detail->sort_number ?? ''" />台目
                </div>

                <!-- 車両名 -->
                <div class="mb-4">
                    <x-input-label for="vehicle_name" :value="__('車両名')" />
                    <x-data-display :value="$appointment_detail->vehicle_name ?? ''" />
                </div>

                <!-- 車両登録番号 -->
                <div class="mb-4">
                    <x-input-label for="registration_number" :value="__('車両登録番号')" />
                    <x-data-display :value="$appointment_detail->registration_number ?? ''" />
                </div>

                <!-- 車両タイプ -->
                <div class="mb-4">
                    <x-input-label for="vehicle_type" :value="__('車両タイプ')" />
                    <x-data-display :value="$appointment_detail->vehicle_type ?? ''" />
                </div>

                <!-- 車検満了日 -->
                <div class="mb-4">
                    <x-input-label for="inspection_due_date" :value="__('車検満了日')" />
                    <x-data-display :value="$appointment_detail->inspection_due_date ?? ''" />
                </div>

                <!-- 追加整備 -->
                <div class="mb-4">
                    <x-input-label for="additional_services" :value="__('追加整備')" />
                    <x-data-display :value="$appointment_detail->additional_services ?? 'なし'" />
                </div>
            @endforeach

            <!-- キャンセルボタン -->
            {{-- <form action="{{ route('appointmentList.destroy', $appointment_detail->id) }}" method="POST"
                    onsubmit="return confirm('本当にキャンセルしますか？');">
                    @csrf
                    @method('DELETE')
                    <div class="mb-4 flex justify-end">
                        <button type="submit"
                            class="ms-3 bg-red-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-800 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            キャンセル
                        </button>
                    </div>
                </form> --}}
        </div>
    </div>
</x-app-layout>
