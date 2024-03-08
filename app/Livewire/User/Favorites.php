<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Favorites extends Component
{
    use WithPagination;

    public $id;
    public $search;
    protected $queryString = ['search'];
    public $title;

    public function render()
    {
        if ($this->id && auth()->user()->isAdmin()) {
            $user = User::find($this->id);
            $this->title = "{$user->name}'s favorites";
        } else {
            $user = auth()->user();
            $this->title = "My favorites";
        }

        $query = $user->favorites()->with('mainImage')->orderBy('user_books.created_at', 'desc');

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%");
        }

        return view('livewire.book.index', [
            'books' => $query->paginate(8)
        ])->layout('layouts.app');
    }

    public function updated($property)
    {
        if ($property === 'search') {
            $this->resetPage();
        }
    }
}
