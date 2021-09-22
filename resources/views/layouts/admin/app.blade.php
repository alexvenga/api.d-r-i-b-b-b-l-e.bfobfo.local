<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin panel</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <style>[x-cloak] {
            display: none;
        }</style>
    <link rel="stylesheet" href="{{ mix('css/app.css', 'assets') }}">

    @livewireStyles

</head>

<body>

<x-admin.notification-livewire/>

<div x-data="{ openSidebarMobile: false }"
     @keydown.window.escape="openSidebarMobile = false"
     class="relative h-screen flex overflow-hidden bg-white">

@include('layouts.admin.sidebar-mobile')

@include('layouts.admin.sidebar-desktop')

<!-- Main column -->
    <div class="flex flex-col w-0 flex-1 overflow-hidden">

        <!-- Main header -->
        <div class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200 lg:hidden">

            <button x-description="Sidebar toggle, controls the 'sidebarOpen' sidebar state."
                    class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-purple-500 lg:hidden"
                    @click="openSidebarMobile = true">
                <x-heroicon-o-menu class="h-6 w-6"/>
            </button>

            <div class="flex-1 flex justify-between items-center px-4 sm:px-6 lg:px-8">
                <div>IP-TV.BEST</div>
                <div class="flex items-center">

                    <!-- Profile dropdown -->
                    <x-dropdown class="ml-3" align="right">

                        <x-slot name="trigger">

                            <button type="button"
                                    class="group w-full bg-gray-100 rounded-md px-3.5 py-2 text-sm text-left font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-purple-500">
                                <span class="flex w-full justify-between items-center">
                                    <span class="flex min-w-0 items-center justify-between space-x-3">
                                        <span class="flex-1 flex flex-col min-w-0">
                                            <span class="text-gray-900 text-sm font-medium truncate">{{ Auth::user()->name }}</span>
                                        </span>
                                    </span>
                                    <x-heroicon-o-selector class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500"/>
                                </span>
                            </button>

                        </x-slot>

                        <x-slot name="content">

                            @include('layouts.admin.user-actions')

                        </x-slot>

                    </x-dropdown>

                </div>
            </div>
        </div>

        <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none">

            {{ $slot }}

        </main>

    </div>
</div>

<script src="{{ mix('js/app.js', 'assets') }}" defer></script>
@livewireScripts
</body>
</html>


