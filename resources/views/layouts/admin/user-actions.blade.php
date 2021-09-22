<div class="py-1" role="none">
    <x-dropdown.link href="{{ route('home') }}">Back to site</x-dropdown.link>
</div>
<div class="py-1" role="none">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); this.closest('form').submit();"
           class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900">
            Logout</a>
    </form>
</div>
