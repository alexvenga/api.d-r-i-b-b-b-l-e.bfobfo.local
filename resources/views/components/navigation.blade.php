<div class="absolute inset-x-0 top-0 p-4 flex items-center justify-end bg-gray-50 shadow">

    @auth

        <div>
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                        <div class="flex items-center space-x-2">
                            <div>
                                <img class="inline-block h-8 w-8 rounded-full"
                                     src="{{ Auth::user()->avatar }}"
                                     alt="">
                            </div>
                            <div>
                                {{ Auth::user()->name }}
                            </div>
                        </div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">

                    @if(Auth::user()->isAdmin())
                        <x-dropdown.link href="{{ route('admin.users') }}">
                            Admin Panel
                        </x-dropdown.link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown.link :href="route('logout')"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            Log Out
                        </x-dropdown.link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

    @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Login</a>
    @endauth
</div>
