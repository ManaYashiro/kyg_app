<x-guest-layout>
    <form id="form-user-register" class="multiPageForm" method="POST" action="{{ $route ?? route('register') }}"
        autocomplete="off">
        @csrf
        @if (isset($route))
            @method('PATCH')
        @endif

        <div id="page-1" class="page block">
            @include('auth.user-profile', [
                'formType' => $formType,
                'submitType' => $submitType,
                'branches' => $branches,
                'user' => $user ?? [],
            ])
        </div>

        <div id="page-2" class="page hidden">
            @include('auth.user-profile-confirm')
        </div>
        <x-navi.page-navi-buttons />
    </form>

    @section('styles')
        @vite(['resources/css/modules/profile.css'])
    @endsection
    @push('modals')
    @endpush
    @push('scripts')
        @vite(['resources/js/modules/registerConfirm.js'])
        @vite(['resources/js/modules/page-navi-buttons.js'])
        @vite(['resources/js/modules/auth/register.js'])
    @endpush
</x-guest-layout>
