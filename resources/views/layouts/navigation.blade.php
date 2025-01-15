<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 w-full">
    <!-- Primary Navigation Menu -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('top') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="flex sm:items-center sm:ms-6">

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

                    {{-- BURGER MENU CONTENT --}}
                    <x-slot name="menucontent">
                        <x-navi.navi-buttons :class="'flex sm:hidden p-4'" buttonColor="border bg-[#c4221c] text-white " />
                        <x-dropdown-link :href="route('categories')">
                            {{ __('作業カテゴリ一覧') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('stores')">
                            {{ __('店舗介') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('guide')">
                            <i class="fa-solid fa-info"></i> {{ __('ご利用ガイド') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('faq')">
                            <i class="fa-solid fa-question"></i> {{ __('よくある質問') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
