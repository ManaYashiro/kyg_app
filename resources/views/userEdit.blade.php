<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto" style="max-width: 90rem;">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto mt-4">
                        <div class="container mx-auto p-4">
                            <h2 class="text-xl font-semibold mb-4">ユーザー情報編集</h2>

                            @if (session('success'))
                                <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('admin.userList.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- 名前 -->
                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('名前')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                        :value="old('name', $user->name ?? '')" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- furigana -->
                                <div class="mb-4">
                                    <x-input-label for="furigana" :value="__('フリガナ')" />
                                    <x-text-input id="furigana" class="block mt-1 w-full" type="text"
                                        name="furigana" :value="old('furigana', $user->furigana ?? '')" required />
                                    <x-input-error :messages="$errors->get('furigana')" class="mt-2" />
                                </div>

                                <!-- メールアドレス -->
                                <div class="mb-4">
                                    <x-input-label for="email" :value="__('メールアドレス')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="text" name="email"
                                        :value="old('email', $user->email ?? '')" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- 電話番号 -->
                                <div class="mb-4">
                                    <x-input-label for="phone_number" :value="__('電話番号')" />
                                    <x-text-input id="phone_number" class="block mt-1 w-full" type="text"
                                        name="phone_number" :value="old('phone_number', $user->phone_number ?? '')" required />
                                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                                </div>

                                <!-- 郵便番号 -->
                                <div class="mb-4">
                                    <x-input-label for="post_code" :value="__('郵便番号')" />
                                    <x-text-input id="post_code" class="block mt-1 w-full" type="text" name="post_code"
                                        :value="old('post_code', $user->post_code ?? '')" required />
                                    <x-input-error :messages="$errors->get('post_code')" class="mt-2" />
                                </div>

                                <!-- 住所 -->
                                <div class="mb-4">
                                    <x-input-label for="address" :value="__('住所')" />
                                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                        :value="old('address', $user->address ?? '')" required />
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>

                                <!-- 建物 -->
                                <div class="mb-4">
                                    <x-input-label for="building" :value="__('建物')" />
                                    <x-text-input id="building" class="block mt-1 w-full" type="text"
                                        name="building" :value="old('name', $user->building ?? '')" />
                                    <x-input-error :messages="$errors->get('building')" class="mt-2" />
                                </div>

                                <!-- 電話時間 -->
                                <div class="mb-4">
                                    <x-input-label for="preferred_contact_time" :value="__('電話希望時間')" />
                                    <x-select id="preferred_contact_time" class="block mt-1 w-full" name="preferred_contact_time">
                                        <option value="" disabled {{ is_null($user->preferred_contact_time) ? 'selected' : '' }}>
                                            選択してください
                                        </option>
                                        <option value="9-12" {{ $user->preferred_contact_time == '9-12' ? 'selected' : '' }}>9:00 - 12:00</option>
                                        <option value="12-13" {{ $user->preferred_contact_time == '12-13' ? 'selected' : '' }}>12:00 - 13:00</option>
                                        <option value="13-15" {{ $user->preferred_contact_time == '13-15' ? 'selected' : '' }}>13:00 - 15:00</option>
                                        <option value="15-17" {{ $user->preferred_contact_time == '15-17' ? 'selected' : '' }}>15:00 - 17:00</option>
                                        <option value="17-19" {{ $user->preferred_contact_time == '17-19' ? 'selected' : '' }}>17:00 - 19:00</option>
                                        <option value="no_preference" {{ $user->preferred_contact_time == 'no_preference' ? 'selected' : '' }}>指定なし</option>
                                    </x-select>
                                    <x-input-error :messages="$errors->get('preferred_contact_time')" class="mt-2" />
                                </div>

                                <!-- 更新ボタン -->
                                <div class="mb-4 flex justify-end">
                                    <!-- 更新ボタン -->
                                    <x-primary-button class="ms-3">更新</x-primary-button>
                                </div>
                            </form>
                            <!-- 削除ボタン -->
                            <form action="{{ route('admin.userList.destroy', $user->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <div class="mb-4 flex justify-end">
                                    <button type="submit" class="ms-3 bg-red-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-800 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        削除
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
