<?php

namespace App\Http\Livewire\Guest\Posts;

use App\Models\Post;
use App\Http\Livewire\MainComponent;

class Index extends MainComponent
{
    public $filters = [
        'publication_date' => null,
    ];

    public function getRowsQuery()
    {
        return Post::query()
            ->with('user')
            ->published()
            ->when(
                $this->filters['publication_date'],
                fn ($query, $publication_date) => $query->filterPublishedDate($publication_date)
            );
    }

    public function render()
    {
        return view('livewire.guest.posts.index', [
            'rows' => $this->rows
        ])->layout('layouts.guest');
    }
}
