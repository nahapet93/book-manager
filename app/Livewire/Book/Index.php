<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    protected $queryString = ['search'];
    public $title;

    public function render()
    {
        $this->title = 'Books';
        $query = Book::query()->with('mainImage')->orderBy('created_at', 'desc');

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

    public function delete($id)
    {
        if (auth()->user()->isAdmin()) {
            $book = Book::find($id);
            $images = $book->images->pluck('image_url')->toArray();
            Storage::disk('public')->delete($images);
            $book->delete();
        }
    }
}
