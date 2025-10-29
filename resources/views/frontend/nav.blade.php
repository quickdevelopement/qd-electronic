<!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
<nav class="relative bg-gradient-to-t  from-green-600 via-green-500 to-green-500 shadow-lg shadow-gray-600/50">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" command="--toggle" commandfor="mobile-menu"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:-outline-offset-1 focus:outline-indigo-500">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                        aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                        aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center">
                    <img src="http://localhost:8000/logo/qd-logo.png" alt="Your Company" class="h-10 w-auto" />
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
                        <a href="{{ route('home') }}" aria-current="page"
                            class="rounded-md {{ request()->routeIs('home') ? 'bg-gray-900 text-white' : 'text-white dark:text-gray-50 hover:bg-slate-900 hover:text-white' }} px-3 py-2 text-sm font-medium">Home</a>
                        <a href="{{ route('products') }}"
                            class="rounded-md {{ request()->routeIs('products') ? 'bg-gray-900 text-white' : 'text-white dark:text-gray-50 hover:bg-slate-900 hover:text-white' }} px-3 py-2 text-sm font-medium">Shop</a>
                        <a href="#"
                            class="rounded-md {{ request()->routeIs('projects') ? 'bg-gray-900 text-white' : 'text-white dark:text-gray-50 hover:bg-slate-900 hover:text-white' }} px-3 py-2 text-sm font-medium">Projects</a>
                        <a href="#"
                            class="rounded-md {{ request()->routeIs('calendar') ? 'bg-gray-900 text-white' : 'text-white dark:text-gray-50 hover:bg-slate-900 hover:text-white' }} px-3 py-2 text-sm font-medium">Calendar</a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <x-nav-link :href="route('carts')" type="button"
                    class="relative  p-1 text-gray-400 ">
                    <span
                        class="absolute -inset-1.5 bg-red-500 text-white w-4 h-4 rounded-full flex items-center justify-center">{{ Auth::user() ? (Auth::user()->cart ? Auth::user()->cart->items->count() : 0) : 0 }}</span>
                    <span class="sr-only">View notifications</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 80 80" xml:space="preserve">
                        <path fill="#18CEF6"
                            d="M26.029 58.156c-1.683 0-3.047 1.334-3.047 2.979 0 1.646 1.364 2.979 3.047 2.979s3.047-1.333 3.047-2.979c0-1.645-1.364-2.979-3.047-2.979zm17.795 0c-1.682 0-3.046 1.334-3.046 2.979 0 1.646 1.364 2.979 3.046 2.979 1.683 0 3.047-1.333 3.047-2.979 0-1.645-1.364-2.979-3.047-2.979zM22.515 26.997l5.416 14.5h21.793l6.189-14.5H22.515z" />
                        <path fill="#233251"
                            d="m58.753 13-9.67 28.181H23.85l-6.527-17.968h29.111v-2.27H14.036l7.722 21.258-6.281 10.643h35.794v-2.271H19.494l4.207-7.125h27.051l9.67-28.18H71V13H58.753zm-33.4 41.861c-3.134.002-5.674 2.484-5.676 5.548.002 3.065 2.542 5.548 5.676 5.549 3.133-.002 5.672-2.485 5.672-5.549 0-3.064-2.539-5.546-5.672-5.548zm0 8.827c-1.853-.003-3.35-1.468-3.353-3.279.003-1.81 1.5-3.274 3.353-3.277 1.849.003 3.349 1.467 3.352 3.277-.003 1.812-1.503 3.276-3.352 3.279zm17.794-8.827c-3.134.002-5.673 2.484-5.674 5.548.001 3.065 2.54 5.548 5.674 5.549 3.134-.002 5.672-2.485 5.674-5.549-.002-3.064-2.54-5.546-5.674-5.548zm0 8.827c-1.851-.003-3.349-1.468-3.352-3.279.003-1.81 1.501-3.274 3.352-3.277 1.851.003 3.35 1.467 3.353 3.277-.003 1.812-1.502 3.276-3.353 3.279z" />
                    </svg>
                </x-nav-link>


                @if (Route::has('login'))
                <div class="flex items-center justify-end gap-4">
                    @auth
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="56">
                            <!-- Profile dropdown -->
                            <x-slot name="trigger">
                                <button
                                    class="relative flex rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Open user menu</span>
                                    @if (Auth::user()->avatar)
                                    <img src="{{ asset('avatar/' . Auth::user()->avatar) }}"
                                        alt="{{ Auth::user()->name }}"
                                        class="size-8 rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10">
                                    @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=random"
                                        alt="Default Avatar"
                                        class="size-8 rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10">
                                    @endif
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="py-2">
                                    <h4 class="px-4  text-lg font-bold text-gray-700 dark:text-gray-200">
                                        {{ Auth::user()->name }}</h4>
                                    <p class="px-4  text-sm text-gray-600 dark:text-gray-400">{{ Auth::user()->email }}
                                    </p>
                                </div>
                                <x-dropdown-link :href="Auth::user()->role === 'admin'? route('dashboard'): route('orders')" >
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('profile')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>

                                <x-dropdown-link :href="route('setting')"
                                    class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:outline-hidden">
                                    {{ __('Settings') }}</x-dropdown-link>

                            </x-slot>
                        </x-dropdown>
                    </div>
                    @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-white text-white border border-transparent hover:border-yellow-500  dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        Log in
                    </a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-white hover:border-yellow-500 border text-white dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Register
                    </a>
                    @endif
                    @endauth
                </div>
                @endif
            </div>
        </div>
    </div>

    <el-dropdown id="mobile-menu" hidden class="block sm:hidden">
        <div class="space-y-1 px-2 pt-2 pb-3">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
            <a href="#" aria-current="page"
                class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Dashboard</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Team</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Projects</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Calendar</a>
        </div>
    </el-dropdown>
</nav>