<!-- Desktop sidebar -->
<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="{{ route('admin.dashboard') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                @if (request()->routeIs('admin.dashboard'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif

                <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                    href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-house"></i>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul>
            {{-- サイドバー --}}
            <li class="relative px-6 py-3">
                @if (request()->routeIs('admin.stores.index'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('admin.stores.index') }}">
                    <i class="fa-solid fa-store"></i>
                    <span class="ml-4">店舗</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (request()->routeIs('admin.userList.index'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('admin.userList.index') }}">
                    <i class="fa-solid fa-user"></i>
                    <span class="ml-4">User List</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (request()->routeIs('admin.notificationSetting.index'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('admin.notificationSetting.index') }}">
                    <i class="fa-regular fa-envelope"></i>
                    <span class="ml-4">Notification Settings</span>
                </a>
            </li>
        </ul>
        {{-- ボータン --}}
        {{--
        <div class="px-6 my-6">
            <button
                class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                Create account
                <span class="ml-2" aria-hidden="true">+</span>
            </button>
        </div>
        --}}
    </div>
</aside>
