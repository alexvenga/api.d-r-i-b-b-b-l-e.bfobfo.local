@props([
    'label',
    'for',
    'error' => false,
    'helpText' => false,
])

<div class="relative flex items-start">

    <div class="flex items-center h-5">
        {{ $slot }}
    </div>
    <div class="ml-3">
        <label for="{{ $for }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
        @if ($error)
            <div class="mt-1 text-sm text-red-600">{{ $error }}</div>
        @endif

        @if ($helpText)
            <p class="mt-1 text-sm">{{ $helpText }}</p>
        @endif
    </div>

</div>

