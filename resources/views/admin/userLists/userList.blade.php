<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto mt-4">
                        @if (session('success'))
                            <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="GET" action="{{ route('admin.userList.index') }}" class="mb-4">
                            <div class="flex items-center gap-4">
                                <!-- Role フィルター -->
                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                    <select name="role" id="role" class="border-gray-300 rounded-md shadow-sm">
                                        <option value="">Select Role</option>
                                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User
                                        </option>
                                    </select>
                                </div>

                                <!-- 名前フィルター -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">名前</label>
                                    <input type="text" name="name" id="name"
                                        class="border-gray-300 rounded-md shadow-sm" value="{{ request('name') }}">
                                </div>

                                <!-- 電話番号フィルター -->
                                <div>
                                    <label for="phone_number"
                                        class="block text-sm font-medium text-gray-700">電話番号</label>
                                    <input type="text" name="phone_number" id="phone_number"
                                        class="border-gray-300 rounded-md shadow-sm"
                                        value="{{ request('phone_number') }}">
                                </div>

                                <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md"
                                    style="margin-top: 18px;">Filter</button>
                            </div>
                        </form>

                        <table class="min-w-full table-auto border-collapse" style="border: 1px solid #ccc;">
                            <!-- ヘッダー部分 -->
                            <thead class="bg-gray-200 sticky top-0 z-10">
                                <tr>
                                    <th class="px-4 py-2 text-left" style="width: 5%;">ID</th>
                                    <th class="px-4 py-2 text-left" style="width: 10%;">Role</th>
                                    <th class="px-4 py-2 text-left" style="width: 15%;">名前</th>
                                    <th class="px-4 py-2 text-left" style="width: 20%;">メールアドレス</th>
                                    <th class="px-4 py-2 text-left" style="width: 10%;">電話番号</th>
                                    <th class="px-4 py-2 text-left" style="width: 20%;">住所</th>
                                    <th class="px-4 py-2 text-left" style="width: 8%;">電話時間</th>
                                    <th class="px-4 py-2 text-left" style="width: 12%;">アンケート</th>
                                    <th class="px-4 py-2 text-left" style="width: 10%;">News</th>
                                </tr>
                            </thead>

                            <!-- ボディ部分 -->
                            <tbody>
                                @foreach ($users as $user)
                                    <tr onclick="window.location='{{ route('admin.userList.edit', $user->id) }}'"
                                        class="clickable-row" style="cursor: pointer;">
                                        <td class="border px-4 py-2 text-xs">{{ $user->id }}</td>
                                        <td class="border px-4 py-2 text-xs">{{ $user->role }}</td>
                                        <td class="border px-4 py-2 text-xs">{{ $user->name }}</td>
                                        <td class="border px-4 py-2 text-xs">{{ $user->email }}</td>
                                        <td class="border px-4 py-2 text-xs">
                                            {{ $user->phone_number }}</td>
                                        <td class="border px-4 py-2 text-xs">
                                            @php
                                                $fullAddress = $user->address . ' ' . $user->building;
                                                $maxLength = 30;
                                                if (strlen($fullAddress) > $maxLength) {
                                                    $fullAddress = mb_substr($fullAddress, 0, $maxLength) . '...';
                                                }
                                            @endphp
                                            {{ $fullAddress }}
                                        </td>
                                        <td class="border px-4 py-2 text-xs">
                                            {{ $user->preferred_contact_time }}
                                        </td>
                                        <td class="border px-4 py-2 text-xs">
                                            @php
                                                $howDidYouHear = is_array($user->how_did_you_hear)
                                                    ? $user->how_did_you_hear
                                                    : (is_string($user->how_did_you_hear)
                                                        ? json_decode($user->how_did_you_hear)
                                                        : []);
                                            @endphp
                                            @foreach ($howDidYouHear as $item)
                                                @switch($item)
                                                    @case(1)
                                                        インターネット広告
                                                    @break

                                                    @case(2)
                                                        SNS
                                                    @break

                                                    @case(3)
                                                        HP
                                                    @break

                                                    @case(4)
                                                        郵便物
                                                    @break

                                                    @case(5)
                                                        店頭看板
                                                    @break

                                                    @case(6)
                                                        屋外広告
                                                    @break

                                                    @case(7)
                                                        折込チラシ
                                                    @break

                                                    @case(8)
                                                        フリーペーパー
                                                    @break

                                                    @case(9)
                                                        家族・知人からの紹介
                                                    @break

                                                    @case(10)
                                                        職場や取引先からの紹介
                                                    @break
                                                @endswitch
                                                @if (!$loop->last)
                                                    <br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="border px-4 py-2 text-xs">
                                            {{ $user->is_newsletter_subscription ? 'Yes' : 'No' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- ページネーション -->
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
