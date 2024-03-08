@section('title', isset($this->user) ? "Edit user - {$this->user->name}" : "Create a user")
<div class="relative rounded-xl overflow-auto p-8">
    <form class="space-y-4" wire:submit="save">
        <div>
            <input wire:model="name" wire:model.blur="name" type="text" placeholder="Name" class="input input-bordered w-full max-w-xs"/>
            <div class="text-error">@error('name') {{ $message }} @enderror</div>
        </div>

        <div>
            <input wire:model="email" wire:model.blur="email" type="email" placeholder="Email" class="input input-bordered w-full max-w-xs"/>
            <div class="text-error">@error('email') {{ $message }} @enderror</div>
        </div>

        <div>
            <input wire:model="password" wire:model.blur="password" type="password" placeholder="Password" class="input input-bordered w-full max-w-xs"/>
            <div class="text-error">@error('password') {{ $message }} @enderror</div>
        </div>

        <div>
            <button type="submit" class="btn btn-active btn-primary w-full max-w-xs">Save</button>
        </div>
    </form>
</div>
