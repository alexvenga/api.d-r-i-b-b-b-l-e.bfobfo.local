<div>

    <x-admin.page-header>
        Files

        <x-slot name="buttons">
            <x-admin.button wire:click="confirmCreate">
                New file
            </x-admin.button>
        </x-slot>
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
                            label="Only deleted"
                            for="deleted">
                            <x-form.input.checkbox id="deleted"
                                                   wire:model="filters.searchOnlyDeleted"/>
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
            <x-admin.table.th sortable wire:click="sortBy('name_local')" :direction="($sortField == 'name_local') ? $sortDirection : null">
                File names
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
            @php /** @var \App\Models\File $row */ @endphp
            <tr class="@if($loop->odd) bg-white @else bg-gray-50 @endif hover:bg-green-50"
                wire:loading.class.delay="opacity-50"
                wire:key="row-{{ $row->id }}">

                <x-admin.table.td class="text-center">
                    <a href="{{ route('file.item', $row) }}" class="underline hover:no-underline"
                       target="_blank">{{ $row->id }}</a>
                </x-admin.table.td>

                <x-admin.table.td>
                    <a href="{{ route('file.item', $row) }}" class="font-bold underline hover:no-underline"
                       target="_blank">{{$row->name_visible }}</a>
                    <div class="text-xs">{{$row->name_local }}</div>
                </x-admin.table.td>

                <x-admin.table.td.data-user :date="$row->created_at" :user="$row->creator"/>
                <x-admin.table.td.data-user :date="$row->updated_at" :user="$row->editor"/>
                <x-admin.table.td.data-user :date="$row->deleted_at" :user="$row->destroyer"/>

                <x-admin.table.td.actions>

                    @if(!$row->deleted_at)
                        <div class="py-1">
                            <button wire:click="edit({{ $row->id }})"
                                    class="text-gray-700 group flex items-center px-4 py-2 text-sm w-full hover:bg-gray-100 hover:text-gray-900">
                                <x-heroicon-o-pencil-alt class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"/>
                                Edit
                            </button>
                        </div>
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

    <form wire:submit.prevent="create">
        <x-admin.modal.dialog wire:model.defer="showCreateModal">

            <x-slot name="title">New file</x-slot>

            <x-slot name="content">
                <x-form.group label="" for="upload-file" :error="$errors->first('upload')"
                              :helpText="$upload ? $upload->getFilename() : ''">
                    <div class="flex space-x-4 items-center">
                        <!-- File Input -->
                        <div class="flex-shrink-0">
                            <x-form.input.file-upload wire:model="upload" id="upload-file"/>
                        </div>
                        <div>
                            <div wire:loading wire:target="upload" class="w-full">Uploading...</div>
                        </div>

                    </div>
                </x-form.group>

                @if ($upload)
                        <x-form.group
                            for="editing-name_visible"
                            label="Visible file name for users"
                            :error="$errors->first('editing.name_visible')">
                            <x-form.input required wire:model="editing.name_visible" id="editing-name_visible"/>
                        </x-form.group>
                        <x-form.group
                            for="editing-name_local"
                            label="File name for storage"
                            :error="$errors->first('editing.name_local')">
                            <x-form.input required wire:model="editing.name_local" id="editing-name_local"/>
                        </x-form.group>
                @endif

            </x-slot>

            <x-slot name="footer">

                <x-admin.button.white wire:click="$set('showCreateModal', false)">Cancel
                </x-admin.button.white>

                @if ($upload)
                    <x-admin.button type="submit">Save</x-admin.button>
                @endif

            </x-slot>

        </x-admin.modal.dialog>

    </form>

    <form wire:submit.prevent="save">
        <x-admin.modal.dialog wire:model.defer="showEditModal">

            <x-slot name="title">File</x-slot>

            <x-slot name="content">

                <x-form.group
                    for="editing-name_visible"
                    label="Visible file name for users"
                    :error="$errors->first('editing.name_visible')">
                    <x-form.input required wire:model="editing.name_visible" id="editing-name_visible"/>
                </x-form.group>

            </x-slot>

            <x-slot name="footer">

                <x-admin.button.white
                        wire:click="$set('showEditModal', false)">Cancel
                </x-admin.button.white>

                <x-admin.button type="submit">Save</x-admin.button>

            </x-slot>

        </x-admin.modal.dialog>

    </form>

    <form wire:submit.prevent="delete">
        <x-admin.modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete file</x-slot>
            <x-slot name="content">
                The file <b>{{ $editing->name_local }}</b> ({{ $editing->name_visible }}) will be deleted!<br>
                In fact, the file is not deleted - the operation is reversible!
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
            <x-slot name="title">Restore the file</x-slot>
            <x-slot name="content">
                The file <b>{{ $editing->name }}</b> ({{ $editing->nickname }}) will be completely restored!
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
