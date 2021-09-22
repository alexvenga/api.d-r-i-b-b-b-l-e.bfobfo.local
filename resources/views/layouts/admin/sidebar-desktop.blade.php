<!-- Static sidebar for desktop -->
<div class="hidden lg:flex lg:flex-shrink-0">
    <div class="flex flex-col w-64 border-r border-gray-200 pt-5 pb-4 bg-gray-100">
        <div class="flex items-center justify-center flex-shrink-0 px-6">
            <a href="{{ route('home') }}">
                <x-heroicon-o-arrow-circle-right class="w-12 h-12"/>
            </a>
        </div>

        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="h-0 flex-1 flex flex-col overflow-y-auto">

            <!-- User account dropdown -->
            <x-dropdown class="px-3 mt-6 inline-block text-left" width="full">

                <x-slot name="trigger">

                    <button type="button"
                            class="group w-full bg-gray-100 rounded-md px-3.5 py-2 text-sm text-left font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-purple-500">
                                <span class="flex w-full justify-between items-center">
                                    <img class="inline-block h-8 w-8 rounded-full"
                                         src="{{ Auth::user()->avatar }}"
                                         alt="">
                                    <span class="flex min-w-0 items-center justify-between space-x-3">
                                        <span class="flex-1 flex flex-col min-w-0">
                                            <span class="text-gray-900 text-sm font-medium truncate">{{ Auth::user()->name }}</span>
                                            <span class="text-gray-500 text-sm truncate">{{ Auth::user()->email }}</span>
                                        </span>
                                    </span>
                                    <x-heroicon-o-selector class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500"/>
                                </span>
                    </button>

                </x-slot>

                <x-slot name="content" class="mx-3">

                    @include('layouts.admin.user-actions')

                </x-slot>

            </x-dropdown>

            <!-- Navigation -->
            <nav class="px-3 mt-6">

                @include('layouts.admin.main-menu')

            </nav>

        </div>
    </div>
</div>
