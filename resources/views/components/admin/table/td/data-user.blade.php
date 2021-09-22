@props([
    'date'=>null,
    'user'=>null
    ])
<x-admin.table.td>
    <div class="text-xs text-center">
        @isset($date)
            <div>{{ $date ? $date->isoFormat('LL') : '-' }}</div>
        @endisset
        @isset($user)
            <div>
                <a class="text-black underline hover:no-underline"
                   href="{{ route('admin.users', ['id'=>$user->id]) }}">{{ $user->name }}</a>
            </div>
        @endisset
    </div>
</x-admin.table.td>
