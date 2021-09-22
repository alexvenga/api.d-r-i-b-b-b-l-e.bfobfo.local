<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class EditFilesComponent extends Component
{

    use WithPerPagePagination, WithSorting, WithCachedRows, WithFileUploads;

    public File $editing;
    public $upload;

    public $filters = [
        'searchAllStrings'  => '',
        'searchOnlyDeleted' => false,
    ];

    public bool $showCreateModal = false;
    public bool $showEditModal = false;
    public bool $showDeleteModal = false;
    public bool $showRestoreModal = false;

    protected $rules = [
        'upload'               => 'nullable|file',
        'editing.name_local'   => 'required|string|max:180',
        'editing.name_visible' => 'required|string|max:191',
    ];

    // init
    public function mount(Request $request)
    {
        $this->editing = $this->makeBlankRow();
    }

    public function updated($propertyName)
    {
        if ($this->hasRuleFor($propertyName)) {
            $this->validateOnly($propertyName);
        }
    }

    // Editing

    public function confirmCreate()
    {

        $this->useCachedRows();

        $this->reset('upload');
        $this->resetErrorBag();

        if ($this->editing->getKey()) {
            $this->editing = $this->makeBlankRow();
        }

        $this->showCreateModal = true;
    }

    public function updatedUpload()
    {
        if (empty($this->editing->name_local)) {
            $this->editing->name_local = $this->upload->getFilename();
        }
        if (empty($this->editing->name_visible)) {
            $this->editing->name_visible = $this->upload->getFilename();
        }
    }

    public function create()
    {
        $this->validate();

        $this->editing->name_local = $this->upload->storeAs('/' . date('Y-m-d'), $this->editing->name_local, 'uploaded-files');

        $this->editing->save();

        $this->showCreateModal = false;
    }

    public function edit(File $row)
    {

        $this->useCachedRows();

        if ($this->editing->isNot($row)) {
            $this->editing = $row;
        }

        $this->showEditModal = true;
    }

    public function save()
    {

        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;
    }

    public function confirmDelete(File $row)
    {

        $this->useCachedRows();

        if ($this->editing->isNot($row)) {
            $this->editing = $row;
        }

        $this->showDeleteModal = true;
    }

    public function delete()
    {

        $this->editing->delete();

        $this->editing = $this->makeBlankRow();

        $this->showDeleteModal = false;
    }

    public function confirmRestore(int $rowId)
    {

        $this->useCachedRows();

        $row = File::withTrashed()->findOrFail($rowId);

        if ($this->editing->isNot($row)) {
            $this->editing = $row;
        }

        $this->showRestoreModal = true;
    }

    public function restore()
    {

        $this->editing->restore();

        $this->editing = $this->makeBlankRow();

        $this->showRestoreModal = false;
    }

    public function makeBlankRow()
    {
        return File::make();
    }

    // service actions

    // show rows

    public function getRowsQueryProperty(): Builder
    {
        $query = File::filter($this->filters)->withTrashed();

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });

    }

    public function render()
    {
        return view('livewire.admin.edit-files-component', [
            'rows' => $this->rows,
        ])->layout('layouts.admin.app');
    }
}
