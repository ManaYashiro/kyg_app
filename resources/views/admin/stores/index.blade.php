<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg overflow-x-auto max-w-full">
                <div class="p-6 text-gray-900">
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

                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">
                        Create New Store
                    </button>
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-8">No.</th>
                                <th class="px-4 py-2 w-32">名前</th>
                                <th class="px-4 py-2 w-32">住所</th>
                                <th class="px-4 py-2 w-8">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stores as $store)
                                <tr>
                                    <td class="border px-4 py-2 ">{{ $store->id }}</td>
                                    <td class="border px-4 py-2 whitespace-nowrap">
                                        {{ $store->name }}
                                    </td>
                                    <td class="border px-4 py-2 whitespace-nowrap">
                                        {{ $store->address }}
                                    </td>
                                    <td class="border px-4 py-2 whitespace-nowrap text-center">
                                        <button wire:click="delete({{ $store->id }})"
                                            class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded"><i
                                                class="fa-regular fa-trash-can"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
