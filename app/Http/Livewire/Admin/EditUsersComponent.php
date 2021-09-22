<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Livewire\Component;

class EditUsersComponent extends Component
{

    use WithPerPagePagination, WithSorting, WithCachedRows;

    public User $editing;

    public $filters = [
        'searchAllStrings' => '',
        'searchIsAdmin' => false,
        'searchOnlyDeleted' => false,
    ];

    public bool $showEditModal = false;
    public bool $showDeleteModal = false;
    public bool $showRestoreModal = false;

    // init
    public function mount(Request $request)
    {

        $this->editing = $this->makeBlankRow();

    }

    //update



    public function changeAdminStatus(User $row)
    {

        $row->is_admin = !$row->is_admin;
        $row->save();

    }

    public function confirmDelete(User $row)
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

    public function confirmRestore(int $userId)
    {

        $this->useCachedRows();

        $row = User::withTrashed()->findOrFail($userId);

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
        return User::make();
    }

    // service actions

    // show rows

    public function getRowsQueryProperty(): Builder
    {
        $query = User::filter($this->filters)->withTrashed();

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
        return view('livewire.admin.edit-users-component', [
            'rows' => $this->rows,
        ])->layout('layouts.admin.app');
    }
}
