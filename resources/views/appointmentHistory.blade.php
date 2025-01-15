<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment Hisotry') }}
        </h2>
    </x-slot>

    <div class="h-full overflow-y-auto p-2 md:p-6 text-gray-900">
        @if (session('success'))
            <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3 bottom-border-text font-bold">
            <span class="">予約一覧</span>
        </div>

        <div class="my-6">
            <h2 class="text-sm font-semibold">現在予約中のもの</h2>
            <table class="min-w-full table-auto border-collapse mt-2" style="border: 1px solid #ccc;">
                <tbody>
                    @if ($filteredGroupedAppointments && $filteredGroupedAppointments->isNotEmpty())
                        <!-- グループ内に現在の日時以降の予約があれば表示 -->
                        <thead class="sticky top-0 z-10">
                            <tr>
                                <th class="px-4 py-2 text-left bg-gray-200" style="width: 8%;">予約番号</th>
                                <th class="px-4 py-2 text-left bg-gray-200" style="width: 10%;">予約日時</th>
                                <th class="px-4 py-2 text-left bg-gray-200" style="width: 10%;">希望店舗</th>
                                <th class="px-4 py-2 text-left bg-gray-200" style="width: 10%;">作業カテゴリ</th>
                                <th class="px-4 py-2 text-left bg-gray-200" style="width: 10%;">作業種別</th>
                                <th class="px-4 py-2 text-left bg-gray-200" style="width: 10%;">個人・法人</th>
                                <th class="px-4 py-2 text-left bg-gray-200" style="width: 20%;">予約する作業</th>
                            </tr>
                        </thead>

                        @foreach ($filteredGroupedAppointments as $appointment)
                            <tr onclick="window.location='{{ route('reservations.edit', $appointment->id) }}';"
                                class="clickable-row" style="cursor: pointer;">
                                {{-- 予約番号: --}}
                                <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                    {{ $appointment->reservation_number }}
                                </td>

                                {{-- 予約日時: 予約日時を表示 --}}
                                <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                    {{ \Carbon\Carbon::parse($appointment->reservation_datetime)->format('Y/m/d H:i:s') }}
                                </td>

                                {{-- 希望店舗 --}}
                                <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                    {{ $appointment->store }}
                                </td>

                                {{-- 作業カテゴリ --}}
                                <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                    {{ $appointment->inspection_type }}
                                </td>

                                {{-- 作業種別 --}}
                                <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                    {{ $appointment->work_type }}
                                </td>

                                {{-- 個人/法人 --}}
                                <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                    {{ $appointment->customer_type }}
                                </td>

                                {{-- 予約する作業 --}}
                                <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                    {{ $appointment->reservation_name }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <div class="px-4 py-2 mb-6">現在予約中の予約はありません</div>
                    @endif
                </tbody>
            </table>
        </div>

        <form method="GET" action="{{ route('reservations.index') }}" class="mb-6">
            <div class="flex items-center gap-4 mt-8">
                <!-- 予約番号並び替え -->
                <div>
                    <label for="sort_number" class="block text-sm font-medium text-gray-700">並び順</label>
                    <select name="sort_number" id="sort_number" class="border-gray-300 rounded-md shadow-sm"
                        onchange="this.form.submit()">
                        <option value="desc" {{ request('sort_number') == 'desc' ? 'selected' : '' }}>予約番号 大きい順
                        </option>
                        <option value="asc" {{ request('sort_number') == 'asc' ? 'selected' : '' }}>予約番号 小さい順
                        </option>
                    </select>
                </div>
            </div>
        </form>

        @if ($appointments && $appointments->isNotEmpty())

            <table class="min-w-full table-auto border-collapse" style="border: 1px solid #ccc;">
                <!-- ヘッダー部分 -->
                <thead class="bg-gray-200 sticky top-0 z-10">
                    <tr>
                        <th class="px-4 py-2 text-left" style="width: 8%;">予約番号</th>
                        <th class="px-4 py-2 text-left" style="width: 10%;">予約日時</th>
                        <th class="px-4 py-2 text-left" style="width: 10%;">希望店舗</th>
                        <th class="px-4 py-2 text-left" style="width: 10%;">作業カテゴリ</th>
                        <th class="px-4 py-2 text-left" style="width: 10%;">作業種別</th>
                        <th class="px-4 py-2 text-left bg-gray-200" style="width: 10%;">個人・法人</th>
                        <th class="px-4 py-2 text-left" style="width: 20%;">予約する作業</th>
                    </tr>
                </thead>

                <!-- ボディ部分 -->
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <!-- 予約番号 -->
                            <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                {{ $appointment->reservation_number }}
                            </td>

                            <!-- 予約日時 -->
                            <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                {{ \Carbon\Carbon::parse($appointment->reservation_datetime)->format('Y/m/d H:i:s') }}
                            </td>

                            <!-- 希望店舗 -->
                            <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                {{ $appointment->store }}
                            </td>

                            <!-- 作業カテゴリ -->
                            <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                {{ $appointment->inspection_type }}
                            </td>

                            <!-- 作業種別 -->
                            <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                {{ $appointment->work_type }}
                            </td>

                            {{-- 個人/法人 --}}
                            <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                {{ $appointment->customer_type }}
                            </td>

                            <!-- 予約する作業 -->
                            <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                {{ $appointment->reservation_name }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="px-4 py-2 mb-6">予約履歴はありません</div>
        @endif
        <x-buttons.actionbutton :id="'login'" name="{{ __('前の画面に戻る') }}" type="button" class="mt-5 px-4 py-4"
        divClass="w-full sm:w-1/2 md:w-1/3 mx-auto" url="{{ route('mypage') }}" :buttonColor="'bg-gray-200 text-black'" />
    </div>
</x-app-layout>
