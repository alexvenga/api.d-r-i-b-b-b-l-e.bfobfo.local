@props(['thead'=>null])
<div class="align-middle inline-block min-w-full max-w-full w-full border-b border-gray-200">
    <table class="min-w-full">
        @isset($thead)
            <thead>
            <tr class="border-t border-gray-200">
                {{ $thead }}
            </tr>
            </thead>
        @endisset
        <tbody class="bg-white divide-y divide-gray-100">
        {{ $slot }}
        </tbody>
    </table>
</div>
