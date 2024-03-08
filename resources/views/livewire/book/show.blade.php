@section('title', "Show book - $book->name")
<div class="relative rounded-xl overflow-auto p-8">
    <div class="mb-4">
        @if(!($this->isFavorite($book->id)))
            <button wire:click="addToFavorites({{$book->id}})" class="btn btn-primary btn-lg">Add to favorites</button>
        @else
            <button wire:click="removeFromFavorites({{$book->id}})" class="btn btn-error btn-lg">Remove from favorites</button>
        @endif
    </div>

    <div class="mb-4">
        <h2 class="card-title w-full max-w-xs">{{ $book->name }}</h2>
    </div>

    <div class="mb-4">
        <p class="w-full max-w-xs">{{ $book->description }}</p>
    </div>

    <div class="mb-4">
        <h3 class="w-full max-w-xs">${{ $book->price }}</h3>
    </div>

    @if ($book->images)
        @foreach($book->images as $key => $image)
            <div class="mb-4 w-full max-w-xs">
                <img src="/storage/{{ $image->image_url }}">
            </div>
        @endforeach
    @endif
</div>
