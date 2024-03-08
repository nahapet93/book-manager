<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Illuminate\Http\UploadedFile;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use SplFileInfo;

/**
 *
 * @property UploadedFile[] $images
 */
class Edit extends Component
{
    use WithFileUploads;

    public Book $book;

    #[Validate]
    public $name;
    #[Validate]
    public $description;
    #[Validate]
    public $price;

    #[Validate]
    public $images;
    #[Validate]
    public $mainImageId;
    public $imageIds;

    public $id;

    public function render()
    {
        return view('livewire.book.edit')->layout('layouts.app');
    }

    public function mount()
    {
        $this->book = Book::find($this->id);
        $this->name = $this->book->name;
        $this->description = $this->book->description;
        $this->price = $this->book->price;
        $this->mainImageId = $this->book->mainImage->id;
        $this->imageIds = $this->book->images->pluck('id')->map(fn ($id) => "$id")->toArray();
    }

    public function save()
    {
        $this->validate();

        $this->book->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ]);

        $this->book->images()->update(['is_main_image' => 0]);
        $this->book->images()->find($this->mainImageId)->update(['is_main_image' => 1]);

        $this->redirectRoute('books', [], true, true);
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|gte:0.01',
            'mainImageId' => 'required',
            'images.*' => 'image|max:1024'
        ];
    }
}
