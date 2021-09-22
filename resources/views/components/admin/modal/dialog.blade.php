@props(['id' => null, 'maxWidth' => null])

<x-admin.modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                {{ $title }}
            </h3>
            <div class="mt-2">
                {{ $content }}
            </div>
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:justify-end sm:space-x-2">
        {{ $footer }}
    </div>
</x-admin.modal>
