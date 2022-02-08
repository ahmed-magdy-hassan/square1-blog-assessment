<?php

namespace App\Traits;

use Livewire\WithPagination;

trait WithPerPagePagination
{
    use WithPagination;

    public $perPage = 10;

    public function mountWithPerPagePagination()
    {
        $this->perPage = session()->get('perPage', $this->perPage);
    }

    public function updatedPerPage($value)
    {
        session()->put('perPage', $value);
    }

    public function applyPagination($query)
    {
        $data = $query->paginate($this->perPage);

        return $data;
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }
}
