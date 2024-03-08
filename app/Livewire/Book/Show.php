<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Livewire\Component;

class Show extends Component
{
    public Book $book;
    public $id;

    public function render()
    {
        return view('livewire.book.show')->layout('layouts.app');
    }

    public function mount()
    {
        $this->book = Book::find($this->id);
    }

    public function addToFavorites($id)
    {
        auth()->user()->favorites()->attach($id);
    }

    public function removeFromFavorites($id)
    {
        auth()->user()->favorites()->detach($id);
    }

    public function isFavorite($id)
    {
        return auth()->user()->favorites()->pluck('book_id')->collect()->contains($id);
    }
}
