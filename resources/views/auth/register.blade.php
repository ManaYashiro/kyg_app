<x-guest-layout>

    <form id="form-user-register" class="multiPageForm" method="POST" action="{{ route('register') }}" autocomplete="off">
        @csrf

        <div id="page-1" class="page block">
            @include('auth.user-profile')
        </div>

        <div id="page-2" class="page hidden">
            @include('auth.user-profile-confirm')
        </div>

        <x-navi.page-navi-buttons />
    </form>

    @push('scripts')
        @vite(['resources/js/modules/auth/register.js'])
        @vite(['resources/js/modules/page-navi-buttons.js'])
    @endpush
</x-guest-layout>
