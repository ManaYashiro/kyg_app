<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 w-full">
    <!-- Primary Navigation Menu -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('top') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                {{-- navibuttons buttons --}}
                <x-navi.navi-buttons />

                <x-dropdown align="right" width="48">
                    {{-- burgermenu button --}}
                    <x-slot name="burgermenu">
                        <button
                            class="inline-flex items-center ms-3 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="ms-1">
                                <div class="flex flex-col w-6" x-show="!open">
                                    <i class="w-6 h-6 fa-solid fa-bars"></i>
                                    <span class="text-xxs">MENU</span>
                                </div>
                                <div class="flex flex-col w-6" x-show="open">
                                    <i class="w-6 h-6 fa-solid fa-x"></i>
                                    <span class="text-xxs">CLOSE</span>
                                </div>
                            </div>
                        </button>
                    </x-slot>

                    {{-- burgermenu content --}}
                    <x-slot name="content">
                        <x-dropdown-link :href="route('categories')">
                            {{ __('作業カテゴリ一覧') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('stores')">
                            {{ __('店舗介') }}
                        </x-dropdown-link>
                        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700" />
                        <x-dropdown-link :href="route('guide')">
                            <i class="fa-solid fa-info"></i> {{ __('ご利用ガイド') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('faq')">
                            <i class="fa-solid fa-question"></i> {{ __('よくある質問') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        {{--
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                        --}}
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-customgray-200 focus:outline-none focus:bg-customgray-200 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('mypage')" :active="request()->routeIs('mypage')">
                {{ __('mypage') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
