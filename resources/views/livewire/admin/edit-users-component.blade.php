<div>

    <x-admin.page-header>
        Users
    </x-admin.page-header>

    <div class="px-4 my-6 sm:px-6 lg:px-8">

        <div class="flex justify-between">

            <div class="w-2/4 flex space-x-4 items-center">
                <div>
                    <x-form.input wire:model.debounce.500ms="filters.searchAllStrings" placeholder="Fast search..."/>
                </div>
                <div>
                    <div class="flex items-center">
                        <x-form.group.checkbox
                            label="Only admins"
                            for="is_admin">
                            <x-form.input.checkbox id="is_admin"
                                                   wire:model="filters.searchIsAdmin"/>
                        </x-form.group.checkbox>
                    </div>
                </div>
            </div>

            <div class="space-x-2 flex items-center">

                <x-form.group.inline for="perPage" label="Show">
                    <x-form.input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </x-form.input.select>
                </x-form.group.inline>

            </div>

        </div>

    </div>

    <x-admin.table>

        <x-slot name="thead">
            <x-admin.table.th sortable class="text-center" wire:click="sortBy('id')">
                ID
            </x-admin.table.th>
            <x-admin.table.th sortable wire:click="sortBy('name')" :direction="($sortField == 'name') ? $sortDirection : null">
                User
            </x-admin.table.th>
            <x-admin.table.th class="text-center" sortable wire:click="sortBy('is_admin')"
                              :direction="($sortField == 'is_admin') ? $sortDirection : null">
                Admin
            </x-admin.table.th>
            <x-admin.table.th class="text-center" sortable wire:click="sortBy('created_at')"
                              :direction="($sortField == 'created_at') ? $sortDirection : null">
                Created
            </x-admin.table.th>
            <x-admin.table.th class="text-center" sortable wire:click="sortBy('updated_at')"
                              :direction="($sortField == 'updated_at') ? $sortDirection : null">
                Updated
            </x-admin.table.th>
            <x-admin.table.th class="text-center" sortable wire:click="sortBy('deleted_at')"
                              :direction="($sortField == 'deleted_at') ? $sortDirection : null">
                Deleted
            </x-admin.table.th>
            <x-admin.table.th/>
        </x-slot>

        @foreach($rows as $row)
            @php /** @var \App\Models\User $row */ @endphp
            <tr class="@if($loop->odd) bg-white @else bg-gray-50 @endif hover:bg-green-50"
                wire:loading.class.delay="opacity-50"
                wire:key="row-{{ $row->id }}">

                <x-admin.table.td class="text-center">
                    {{ $row->id }}
                </x-admin.table.td>

                <x-admin.table.td>
                    <a href="https://dribbble.com/{{ $row->nickname }}" target="_blank"
                       class="flex space-x-4 underline hover:no-underline">
                        <div>
                            <img class="inline-block h-8 w-8 rounded-full"
                                 src="{{$row->avatar }}"
                                 alt="">
                        </div>
                        <div>
                            <div class="font-bold">{{ $row->name }}</div>
                            <div class="text-sm">{{ $row->nickname }}</div>
                        </div>
                    </a>
                </x-admin.table.td>

                <x-admin.table.td class="text-center">
                    <button type="button"
                            class="@if($row->is_admin) bg-indigo-600 @else bg-gray-200 @endif relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            wire:click="changeAdminStatus({{ $row->id }})">
                        <span aria-hidden="true"
                              class="@if($row->is_admin) translate-x-5 @else translate-x-0 @endif pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                    </button>
                </x-admin.table.td>

                <x-admin.table.td.data-user :date="$row->created_at" :user="$row->creator"/>
                <x-admin.table.td.data-user :date="$row->updated_at" :user="$row->editor"/>
                <x-admin.table.td.data-user :date="$row->deleted_at" :user="$row->destroyer"/>

                <x-admin.table.td.actions>

                    @if(!$row->deleted_at)
                        <div class="py-1">
                            <button wire:click="confirmDelete({{ $row->id }})"
                                    class="text-gray-700 group flex items-center px-4 py-2 text-sm w-full hover:bg-gray-100 hover:text-gray-900">
                                <x-heroicon-o-trash class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"/>
                                Delete
                            </button>
                        </div>
                    @else
                        <div class="py-1">
                            <button wire:click="confirmRestore({{ $row->id }})"
                                    class="text-gray-700 group flex items-center px-4 py-2 text-sm w-full hover:bg-gray-100 hover:text-gray-900">
                                <x-heroicon-o-trash class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"/>
                                Restore
                            </button>
                        </div>
                    @endif

                </x-admin.table.td.actions>

            </tr>

        @endforeach

    </x-admin.table>

    <div class="px-4 my-6 sm:px-6 lg:px-8">
        {{ $rows->links() }}
    </div>

    <form wire:submit.prevent="delete">
        <x-admin.modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete user</x-slot>
            <x-slot name="content">
                The user <b>{{ $editing->name }}</b> ({{ $editing->nickname }}) will be deleted!<br>
                In fact, the user is not deleted - the operation is reversible!<br>
                The user will not be able to log in!
            </x-slot>
            <x-slot name="footer">

                <x-admin.button.white wire:click="$set('showDeleteModal', false)">
                    Cancel
                </x-admin.button.white>

                <x-admin.button type="submit">
                    Delete
                </x-admin.button>

            </x-slot>
        </x-admin.modal.confirmation>
    </form>

    <form wire:submit.prevent="restore">
        <x-admin.modal.confirmation wire:model.defer="showRestoreModal">
            <x-slot name="title">Restore the user</x-slot>
            <x-slot name="content">
                The user <b>{{ $editing->name }}</b> ({{ $editing->nickname }}) will be completely restored!
            </x-slot>
            <x-slot name="footer">

                <x-admin.button.white wire:click="$set('showDeleteModal', false)">
                    Cancel
                </x-admin.button.white>

                <x-admin.button type="submit">
                    Restore
                </x-admin.button>

            </x-slot>
        </x-admin.modal.confirmation>
    </form>

</div>
