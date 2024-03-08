<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Illuminate\Http\UploadedFile;
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
class Create extends Component
{
    use WithFileUploads;

    #[Validate]
    public $name = '';
    #[Validate]
    public $description = '';
    #[Validate]
    public $price = '';

    #[Validate]
    public $images;
    #[Validate]
    public $mainImageKey = '';

    public function render()
    {
        return view('livewire.book.create')->layout('layouts.app');
    }

    public function save()
    {
        $this->validate();

        $fileNames = [];
        foreach ($this->images as $key => $image) {
            $imageUrl = $image->store('images', ['disk' => 'public']);
            $path = storage_path('app/public');
            $info = new SplFileInfo($imageUrl);

            $file = Image::load("$path/$imageUrl");
            $file->fit(Manipulations::FIT_CROP, 384, 288)
                ->optimize()->save("$path/images/resized_{$info->getFilename()}");

            $fileNames[] = [
                'image_url' => $imageUrl,
                'is_main_image' => ($key === +$this->mainImageKey ? 1 : 0)
            ];
        }

        $book = Book::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ]);

        $book->images()->createMany($fileNames);

        $this->redirectRoute('books', [], true, true);
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|gte:0.01',
            'images' => 'required',
            'mainImageKey' => 'required',
            'images.*' => 'image|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'mainImageKey.required' => 'You need to specify a main image.'
        ];
    }
}
