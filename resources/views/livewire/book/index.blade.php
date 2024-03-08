@section('title', $this->title)
<div class="relative rounded-xl overflow-auto p-8">
    @if(auth()->user()?->isAdmin())
        <div class="mb-4">
            <a href="{{ route('book-create') }}" class="btn btn-primary btn-lg" wire:navigate>Create a book</a>
        </div>
    @endif

    <div class="mb-4">
        <input wire:model.live.debounce.250ms="search" class="input input-bordered w-full max-w-xs" placeholder="Search">
    </div>

    @if(count($books) === 0)
        There are no books
    @endif

    <div class="grid grid-cols-4 gap-4">
        @foreach($books as $book)
            <div class="card w-96 bg-base-100 shadow-xl">
                <figure><img src="/storage/{{ $book->mainImage?->resizedUrl() }}"/></figure>
                <div class="card-body">
                    <h2 class="card-title">{{ $book->name }}</h2>
                    <p>{{ Str::limit($book->description, 150, $end='...') }}</p>
                    <h3>${{ $book->price }}</h3>
                    @auth
                        <div class="card-actions justify-center">
                            @if(auth()->user()?->isAdmin())
                                <a href="{{ route('book-edit', ['id' => $book->id]) }}" class="btn btn-success" wire:navigate>Edit</a>
                                <button wire:click="delete({{ $book->id }})" wire:confirm="Are you sure you want to delete this book?" class="btn btn-error">Delete</button>
                            @else
                                <a href="{{ route('book-show', ['id' => $book->id]) }}" class="btn btn-success" wire:navigate>Show more</a>
                            @endif
                        </div>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>

    <div class="float-right m-8">
        {{ $books->links() }}
    </div>

</div>

