@props([
    'leadingAddOn' => false,
])

<div class="flex">
    @if ($leadingAddOn)
        <span class="inline-flex items-center px-3 border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            {{ $leadingAddOn }}
        </span>
    @endif

    <input {{ $attributes->merge([
        'class' => 'appearance-none block w-full px-3 py-2 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm',
        'type' =>'text',
    ]) }}/>
</div>
