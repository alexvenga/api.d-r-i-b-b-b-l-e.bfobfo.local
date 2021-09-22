<?php

namespace App\Http\Livewire\Traits;

trait WithSorting
{
    public string $sortField = '';
    public string $sortDirection = '';

    public function sortBy($field)
    {

        if ($this->sortField != $field) {
            $this->sortDirection = 'asc';
            $this->sortField = $field;

            return $this;
        }

        if ($this->sortDirection === 'asc') {
            $this->sortDirection = 'desc';

            return $this;
        }

        if ($this->sortDirection === 'desc') {
            $this->sortDirection = 'asc';

            return $this;
        }

        return $this;
    }

    public function applySorting($query)
    {
        if ($this->sortField && $this->sortDirection) {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        return $query;
    }
}
