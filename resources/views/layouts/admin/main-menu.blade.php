<div class="space-y-1">

    <a href="{{ route('admin.users') }}"
       class="text-gray-900 group flex items-center px-2 py-2 text-base leading-5 font-medium rounded-md
            @if(Route::is('admin.users')) bg-gray-200 @else hover:bg-gray-50 @endif">
        <x-heroicon-o-users class="text-gray-500 mr-3 flex-shrink-0 h-6 w-6"/>
        Users
    </a>

</div>

{{--
<div class="mt-8">
    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider" id="teams-headline">
        Управление сайтом
    </h3>
    <div class="mt-1 space-y-1" role="group" aria-labelledby="teams-headline">


        <a href="{{ route('admin.languages') }}"
               class="group flex items-center px-3 py-2 text-base leading-5 font-medium text-gray-600 rounded-md
               @if(Route::is('admin.languages')) bg-gray-200 @else hover:text-gray-900 hover:bg-gray-50 @endif">
                <span class="w-2.5 h-2.5 mr-4 bg-yellow-500 rounded-full" aria-hidden="true"></span>
                <span class="truncate">Языки сайта</span>
            </a>

    </div>
</div>

--}}
