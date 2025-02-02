<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="bg-white h-full overflow-hidden shadow-sm border border-gray-800 border-r-0 border-b-0">
        <div class="h-full overflow-y-auto p-2 md:p-6 text-gray-900">
            @if (session('success'))
                <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                    {{ session('success') }}
                </div>
            @endif
            <span class="font-bold">会員一覧</span>
            <div class="border border-gray-300 p-4 justify-center mt-7">
                <form method="GET" action="{{ route('admin.userList.index') }}" class="mx-auto w-full max-w-4xl">
                    <div class="flex justify-between gap-6">
                        <div class="w-full">
                            <span class="">会員検索</span>

                            <!-- Role -->
                            <div class="flex items-center gap-4 mb-4 mt-3">
                                <label for="role" class="text-xs font-medium text-gray-700 w-1/3">Role</label>
                                <select name="role" id="role"
                                    class="block w-2/3 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs">
                                    <option value="">Select Role</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User
                                    </option>
                                </select>
                            </div>

                            <!-- 顧客名とフリガナを横並び -->
                            <div class="flex gap-6 mb-4">
                                <div class="flex items-center w-1/2">
                                    <label for="name" class="text-xs font-medium text-gray-700 w-1/3">顧客名</label>
                                    <input type="text" name="name" id="name"
                                        class="block w-full border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs"
                                        value="{{ request('name') }}">
                                </div>
                                <div class="flex items-center w-1/2">
                                    <label for="name_furigana"
                                        class="text-xs font-medium text-gray-700 w-1/3">フリガナ</label>
                                    <input type="text" name="name_furigana" id="name_furigana"
                                        class="block w-full border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs"
                                        value="{{ request('name_furigana') }}">
                                </div>
                            </div>

                            <!-- ログインIDと電話番号を横並び -->
                            <div class="flex gap-6 mb-4">
                                <div class="flex items-center w-1/2">
                                    <label for="loginid" class="text-xs font-medium text-gray-700 w-1/3">ログインID</label>
                                    <input type="text" name="loginid" id="loginid"
                                        class="block w-full border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs"
                                        value="{{ request('loginid') }}">
                                </div>
                                <div class="flex items-center w-1/2">
                                    <label for="phone_number"
                                        class="text-xs font-medium text-gray-700 w-1/3">電話番号</label>
                                    <input type="text" name="phone_number" id="phone_number"
                                        class="block w-full border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs"
                                        value="{{ request('phone_number') }}">
                                </div>
                            </div>

                            <!-- メールアドレスと誕生日を横並び -->
                            <div class="flex gap-6 mb-4">
                                <div class="flex items-center w-1/2">
                                    <label for="email"
                                        class="text-xs font-medium text-gray-700 w-1/3">メールアドレス</label>
                                    <input type="text" name="email" id="email"
                                        class="block w-full border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs"
                                        value="{{ request('email') }}">
                                </div>
                                <div class="flex items-center w-1/2">
                                    <label for="birthday_month"
                                        class="text-xs font-medium text-gray-700 w-1/3">誕生日</label>
                                    <div class="flex">
                                        <input type="text" name="birthday_month" id="birthday_month"
                                            class="block w-1/4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs"
                                            value="{{ request('birthday_month') }}" placeholder="">
                                        <label class="text-xs mt-4">月</label>
                                        <input type="text" name="birthday_day" id="birthday_day"
                                            class="block w-1/4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs"
                                            value="{{ request('birthday_day') }}" placeholder="">
                                        <label class="text-xs mt-4">日</label>
                                    </div>
                                </div>
                            </div>

                            <!-- 並び替え（登録順） -->
                            <div class="flex gap-6 mb-4">
                                <div class="flex items-center w-1/2">
                                    <label for="registration_order"
                                        class="text-xs font-medium text-gray-700 w-1/3">登録日</label>
                                    <input type="radio" id="registration_newest" name="registration_order"
                                        value="newest" {{ request('registration_order') == 'newest' ? 'checked' : '' }}
                                        class="mr-4">
                                    <div class="flex items-center">
                                        <label for="registration_newest" class="mr-2 text-xs">新しい順</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" id="registration_oldest" name="registration_order"
                                            value="oldest"
                                            {{ request('registration_order') == 'oldest' ? 'checked' : '' }}
                                            class="mr-4">
                                        <label for="registration_oldest" class="mr-2 text-xs">古い順</label>
                                    </div>
                                </div>
                                <div class="flex items-center w-1/2">
                                    <label for="update_order"
                                        class="text-xs font-medium text-gray-700 w-1/3">更新日</label>
                                    <input type="radio" id="update_order_newest" name="update_order"
                                        value="newest" {{ request('update_order') == 'newest' ? 'checked' : '' }}
                                        class="mr-4">
                                    <div class="flex items-center">
                                        <label for="update_order_newest" class="mr-2 text-xs">新しい順</label>
                                    </div>
                                    <input type="radio" id="update_order_oldest" name="update_order"
                                        value="oldest" {{ request('update_order') == 'oldest' ? 'checked' : '' }}
                                        class="mr-4">
                                    <div class="flex items-center">
                                        <label for="update_order_oldest" class="mr-2 text-xs">古い順</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-center mt-4">
                        <label id="reset"
                            class="text-sm w-auto mr-10 whitespace-nowrap cursor-pointer">検索条件をリセット</label>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">検索する</button>
                    </div>
                </form>
            </div>

            <div
                class="my-3 pb-2 border border-t-0 border-l-0 border-r-0 border-b-gray-400 flex justify-between items-center">
                <span class="font-bold">会員一覧</span>
                <div class="flex gap-2 justify-center items-center w-[250px]">
                    <x-buttons.actionbutton name="CSVでダウンロード" type="button" class="text-sm p-2" divClass="grow-[2]"
                        url="{{ route('admin.userList.downloadUsersAsCSV', request()->query()) }}" />
                    <x-buttons.actionbutton name="新規作成" type="button" class="text-sm p-2" divClass="grow-[1]"
                        url="{{ route('admin.userList.create') }}" />
                </div>
            </div>

            <div class="flex justify-between items-center mb-4">
                <!-- 削除ボタン -->
                <button id="delete-selected" class="bg-red-500 text-white px-4 py-2 rounded-md disabled:bg-red-300"
                    disabled>チェックした項目を削除</button>
                <!-- ページネーション -->
                <div class="mt-4">
                    {{ $users->appends(request()->query())->links('vendor.pagination.admin') }}
                </div>

            </div>

            <!-- テーブル -->
            <table class="min-w-full table-auto border-collapse" style="border: 1px solid #ccc;">
                <thead class="bg-gray-200 top-0 z-10">
                    <tr>
                        <th class="px-4 py-2 text-left" style="width: 5%;">
                            <input type="checkbox" id="select-all" class="select-all-checkbox">
                        </th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 10%;">Role</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 10%;">会員番号</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 5%;">ログインID</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 15%;">顧客名</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 20%;">メールアドレス</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 10%;">電話番号</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 10%;">誕生日</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="clickable-row" style="cursor: pointer;">
                            <td class="border px-4 py-2 text-xs">
                                <input type="checkbox" class="user-checkbox" data-id="{{ $user->id }}">
                            </td>
                            <td class="border px-4 py-2 text-xs">{{ $user->role->value }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $user->customer_no }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $user->loginid }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $user->name }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $user->email }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $user->phone_number }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $user->birthday }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @section('styles')
    @endsection
    @push('scripts')
        @vite(['resources/js/modules/appointments/admin-form.js'])
    @endpush
</x-admin-app-layout>
