@props([
    'label',
    'for',
    'error' => false,
    'helpText' => false,
])

<div class="py-4">
    <label for="{{ $for }}" class="font-bold block text-sm font-medium text-gray-700">{{ $label }}</label>

    <div class="mt-1">

        <div class="relative">
            {{ $slot }}
        </div>

        @if ($error)
            <div class="mt-2 text-sm text-red-600">{{ $error }}</div>
        @endif

        @if ($helpText)
            <p class="mt-2 text-sm">{{ $helpText }}</p>
        @endif

    </div>

</div>
