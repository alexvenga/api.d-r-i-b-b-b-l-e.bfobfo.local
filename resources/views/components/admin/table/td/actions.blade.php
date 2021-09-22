@props(['edit'=>null, 'delete'=>null])
<td class="pr-6">
    <div class="relative flex justify-end items-center"
         x-data="{ openTableDropdown: false }"
         @click.away="openTableDropdown = false"
         @close.stop="openTableDropdown = false"
         @keydown.escape.stop="openTableDropdown = false">
        <button type="button"
                class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                @click="openTableDropdown = ! openTableDropdown">
            <x-heroicon-o-dots-vertical class="w-5 h-5"/>
        </button>
        <div
            class="mx-3 origin-top-right absolute right-7 top-0 w-48 mt-1 rounded-md shadow-lg z-10 bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200 focus:outline-none"
            x-cloak x-show="openTableDropdown"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95">

            {{ $slot }}

        </div>
    </div>
</td>
