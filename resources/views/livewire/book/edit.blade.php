@section('title', "Edit book - $book->name")
<div class="relative rounded-xl overflow-auto p-8">
    <form class="space-y-4" wire:submit="save">
        <div>
            <input wire:model="name" wire:model.blur="name" type="text" placeholder="Name" class="input input-bordered w-full max-w-xs"/>
            <div class="text-error">@error('name') {{ $message }} @enderror</div>
        </div>

        <div>
            <textarea wire:model="description" wire:model.blur="description" class="textarea textarea-bordered textarea-lg w-full max-w-xs" placeholder="Description"></textarea>
            <div class="text-error">@error('description') {{ $message }} @enderror</div>
        </div>

        <div>
            <input wire:model="price" wire:model.blur="price" type="number" step="0.01" placeholder="Price" class="input input-bordered w-full max-w-xs"/>
            <div class="text-error">@error('price') {{ $message }} @enderror</div>
        </div>

        @if ($book->images)
            @foreach($book->images as $key => $image)
                <label class="block mb-4 w-full max-w-xs">
                    <img class="cursor-pointer mb-1" src="/storage/{{ $image->image_url }}">
                    <input name="mainImageId" type="radio" wire:model="mainImageId" class="radio mr-1" value="{{ $image->id }}" />Main image
                </label>
            @endforeach
            <div class="text-error">@error('mainImageKey') {{ $message }} @enderror</div>
        @endif

        <div>
            <button type="submit" class="btn btn-active btn-primary w-full max-w-xs">Save</button>
        </div>
    </form>
</div>
