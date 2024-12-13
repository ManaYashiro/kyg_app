<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm border border-gray-800 border-r-0 border-b-0">
        <div class="p-6 text-gray-900">
            {{ __("You're logged in!") }}
        </div>
    </div>
</x-app-layout>
