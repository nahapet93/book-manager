<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookImage;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory(100)->create()
            ->each(function ($book) {
                $book->images()->saveMany(BookImage::factory(3)->make([
                    'is_main_image' => 1
                ]));
            });
    }
}
