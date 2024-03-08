<?php

use App\Livewire\Book\Show as BookShow;
use App\Livewire\Book\Create as BookCreate;
use App\Livewire\Book\Edit as BookEdit;
use App\Livewire\Book\Index as Books;

use App\Livewire\User\Create as UserCreate;
use App\Livewire\User\Edit as UserEdit;
use App\Livewire\User\Favorites;
use App\Livewire\User\Index as Users;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Books::class)->name('books');
Route::get('/book/show/{id}', BookShow::class)->middleware(['auth', 'verified'])->name('book-show');
Route::get('/book/create', BookCreate::class)->middleware(['auth', 'verified', 'admin'])->name('book-create');
Route::get('/book/edit/{id}', BookEdit::class)->middleware(['auth', 'verified', 'admin'])->name('book-edit');


Route::get('/users', Users::class)->middleware(['auth', 'verified', 'admin'])->name('users');
Route::get('/user/create', UserCreate::class)->middleware(['auth', 'verified', 'admin'])->name('user-create');
Route::get('/user/edit/{id}', UserEdit::class)->middleware(['auth', 'verified', 'admin'])->name('user-edit');
Route::get('/favorites/{id?}', Favorites::class)->middleware(['auth', 'verified'])->name('favorites');

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

require __DIR__.'/auth.php';
