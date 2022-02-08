<?php

namespace App\Http\Livewire\Web\Users;

use App\Http\Livewire\MainComponent;
use App\Models\User;

class Index extends MainComponent
{
    public $showVerifyModal = false;

    protected $listeners = [
        'refreshImport' => '$refresh'
    ];

    public $filters = [
        'search' => null,
        'email' => null,
    ];

    public function getRowsQuery()
    {
        return User::query()
            ->when($this->filters['search'], fn ($query, $search) => $query->whereMacroSearch('name', strtolower($search)))
            ->when($this->filters['email'], fn ($query, $email) => $query->whereMacroSearch('email', strtolower($email)));
    }

    //TODO: find a cleaner way to handle this
    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->get()->each(function ($user) {
            $user->delete();
        });

        $this->showDeleteModal = false;

        $this->macroNotify('You\'ve deleted ' . $deleteCount . ' users');
    }

    public function verifySelected()
    {
        $verifiedCount = $this->selectedRowsQuery->where('email_verified_at', null)->count();
        $this->selectedRowsQuery->where('email_verified_at', null)->update([
            'email_verified_at' => now()
        ]);
        $this->selected = [];
        $this->showVerifyModal = false;
        $this->macroNotify('You\'ve verified ' . $verifiedCount . ' users');
    }

    public function render()
    {
        return view('livewire.web.users.index', [
            'rows' => $this->rows
        ])->layout('layouts.app');
    }
}
