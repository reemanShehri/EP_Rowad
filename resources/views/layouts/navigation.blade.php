<nav x-data="{ open: false }" class="bg-[#e6d4b6] border-b border-[#d3c1a1]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown with Avatar -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="flex items-center space-x-4">
                    <!-- User Avatar -->


                    <div class="shrink-0">
                        @php
                            $user = auth()->user();
                            $avatar = $user->avatar
                                ? asset('images/profile_photos/' . Auth::user()->avatar)
                                : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=random';
                        @endphp
                        <img src="{{ $avatar }}"
                             class="h-10 w-10 rounded-full object-cover border-2 border-gray-300"
                             alt="{{ $user->name }}">
                    </div>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                           <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-transparent hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
    <div>{{ Auth::user()->name }}</div>

    <div class="ms-1">
        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </div>
</button>

                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>



        @push('styles')
<style>
    /* إصلاح مشكلة نزول المحتوى */
    .relative > .absolute {
        position: fixed !important;
        top: 4rem !important; /* تعدل حسب ارتفاع الهيدر */
        right: 1rem !important;
        z-index: 50 !important;
    }

    /* منع تأثير القائمة على تدفق الصفحة */
    [x-data="{ open: false }"] {
        position: static !important;
    }
</style>
@endpush


        <!-- Responsive Settings Options -->
    {{-- <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="flex items-center px-4"> --}}

                <div class="relative">
    <div class="fixed top-16 right-4 z-50 mt-2 w-64 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 transition-all duration-300 transform origin-top-right"
         x-show="open"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @click.away="open = false">

        <!-- محتوى القائمة الحالي كما هو -->
        <div class="pt-4 pb-1 border-t border-gray-200">

            @php
                            $user = auth()->user();
                            $avatar = $user->avatar
                                ? asset('images/profile_photos/' . Auth::user()->avatar)
                                : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=random';
                        @endphp
                        <img src="{{ $avatar }}"
                             class="h-10 w-10 rounded-full object-cover border-2 border-gray-300"
                             alt="{{ $user->name }}">


                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ $user->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ $user->email }}</div>
                </div>
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

            </div>
</nav>
