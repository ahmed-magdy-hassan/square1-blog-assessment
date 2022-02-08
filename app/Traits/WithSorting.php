<?php

namespace App\Traits;

trait WithSorting
{
    public $sorts = [];

    public function sortBy($field)
    {
        if (!isset($this->sorts[$field])) return $this->sorts[$field] = 'asc';

        if ($this->sorts[$field] === 'asc') return $this->sorts[$field] = 'desc';

        unset($this->sorts[$field]);
    }

    public function sortByDirection($field, $direction = null)
    {

        if ($direction === 'asc') return $this->sorts[$field] = 'asc';
        if ($direction === 'desc') return $this->sorts[$field] = 'desc';

        unset($this->sorts[$field]);
    }

    public function applySorting($query)
    {
        foreach ($this->sorts as $field => $direction) {
            $query->orderBy($field, $direction);
        }

        return $query;
    }
}
