<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $query = User::query()->orderBy('created_at', 'desc');

        return view('livewire.user.index', [
            'users' => $query->paginate(10)
        ])->layout('layouts.app');
    }

    public function delete($id)
    {
        User::find($id)->delete();
    }
}
