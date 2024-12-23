<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white h-full overflow-hidden shadow-sm border border-gray-800 border-r-0 border-b-0">
        <div class="h-full overflow-y-auto p-6 text-gray-900">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                    role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <a href="{{ route('admin.stores.create') }}">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 text-xs rounded my-3">
                    登録
                </button>
            </a>
            <div class="overflow-x-automax-w-full">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 w-8">ID.</th>
                            <th class="px-4 py-2 w-20">名前</th>
                            <th class="px-4 py-2 w-20">メールアドレス</th>
                            <th class="px-4 py-2 w-20">電話番号</th>
                            <th class="px-4 py-2 w-20">住所</th>
                            <th class="px-4 py-2 w-8">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stores as $store)
                            <tr data-url="{{ route('admin.stores.update', $store->id) }}"
                                data-store="{{ $store }}">
                                <td class="border px-4 py-2 text-xs">{{ $store->id }}</td>
                                <td class="border px-4 py-2 text-xs whitespace-nowrap">
                                    {{ $store->name }}
                                </td>
                                <td class="border px-4 py-2 text-xs whitespace-nowrap">
                                    {{ $store->email }}
                                </td>
                                <td class="border px-4 py-2 text-xs whitespace-nowrap">
                                    {{ $store->phone_number }}
                                </td>
                                <td class="border px-4 py-2 text-xs whitespace-nowrap">
                                    {{ $store->address }}
                                </td>
                                <td
                                    class="border px-4 py-2 text-xs whitespace-nowrap text-center flex flex-row gap-2 items-center justify-evenly">
                                    <a href="{{ route('admin.stores.edit', $store->id) }}">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 text-xs px-4 rounded">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route('admin.stores.destroy', $store->id) }}"
                                        id="form-delete--model" method="POST" data-title="店舗">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="delete--model bg-red-500 hover:bg-red-700 text-white font-bold py-2 text-xs px-4 rounded">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $stores->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
    @section('styles')
    @endsection
    @push('scripts')
    @endpush
</x-admin-app-layout>
