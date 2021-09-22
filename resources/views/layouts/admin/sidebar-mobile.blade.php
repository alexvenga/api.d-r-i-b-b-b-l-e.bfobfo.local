<!-- Sidebar mobile -->
<div x-show="openSidebarMobile" x-cloak class="fixed inset-0 flex z-40 lg:hidden"
     x-ref="dialog">

    <div x-show="openSidebarMobile" x-cloak
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-75"
         @click="openSidebarMobile = false"></div>

    <div x-show="openSidebarMobile" x-cloak
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white">

        <div x-show="openSidebarMobile" x-cloak
             x-transition:enter="ease-in-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in-out duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute top-0 right-0 -mr-12 pt-2">
            <button
                    class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    @click="openSidebarMobile = false">
                <x-heroicon-o-x class="h-6 w-6 text-white"/>
            </button>
        </div>

        <div class="flex-1 h-0 overflow-y-auto">
            <nav class="px-2">

                @include('layouts.admin.main-menu')

            </nav>
        </div>
    </div>

    <div class="flex-shrink-0 w-14">
        <!-- Dummy element to force sidebar to shrink to fit close icon -->
    </div>
</div>
