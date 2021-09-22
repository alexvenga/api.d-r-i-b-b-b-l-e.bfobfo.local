<x-app-layout>
    <div class="space-y-2 max-w-lg bg-white p-8 shadow-md sm:rounded-md">
        <h1 class="font-bold text-2xl">Скачать файл</h1>
        <p>
            На этой странице подписчики
            <b><a href="https://dribbble.com/{{ config('services.dribbble.follow_nickname') }}"
               class="underline hover:no-underline">
                {{ config('services.dribbble.follow_name') }}</a></b>
            могут скачать файл <b>{{ $file->name_visible }}</b>
        </p>
        <p>
            <a href="{{ route('file.download', $file) }}"
               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span>
                    <span class="uppercase font-bold">
                        Скачать
                    </span>
                    <span class="block text-xs">
                        Вы должны быть авторизованны и подписаны на
                        {{ config('services.dribbble.follow_name') }}!
                    </span>
                </span>
            </a>
        </p>
    </div>
</x-app-layout>
