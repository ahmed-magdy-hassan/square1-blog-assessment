<?php

namespace App\Http\Livewire\Web\Posts;

use App\Models\Post;
use App\Http\Livewire\MainComponent;

class Index extends MainComponent
{
    public $user;

    public $filters = [
        'publication_date' => null,
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function getRowsQuery()
    {
        return Post::query()
            ->with('user')
            ->where('user_id', $this->user->id)
            ->when(
                $this->filters['publication_date'],
                fn ($query, $publication_date) => $query->filterPublishedDate($publication_date)
            );
    }

    public function render()
    {
        return view('livewire.web.posts.index', [
            'rows' => $this->rows
        ])->layout('layouts.app');
    }
}
