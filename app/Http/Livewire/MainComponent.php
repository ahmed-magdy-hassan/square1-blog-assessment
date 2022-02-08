<?php


namespace App\Http\Livewire;


use App\Traits\WithBulkActions;
use App\Traits\WithCachedRows;
use App\Traits\WithPerPagePagination;
use App\Traits\WithSorting;
use Livewire\Component;
use Livewire\Exceptions\MethodNotFoundException;

class MainComponent extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;

    public $showDeleteModal = false;
    public $showFilters = false;
    public $filters = [];

    protected $queryString = ['sorts' => ['except' => []]];

    public function getRowsQuery()
    {
        return null;
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = !$this->showFilters;
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->macroNotify('You\'ve deleted ' . $deleteCount . ' items');
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function getRowsQueryProperty()
    {
        $query = $this->getRowsQuery();

        if (is_null($query)) {

            throw new MethodNotFoundException('getRowsQuery', static::getName());
        }

        return $this->applySorting($query);
    }
}
