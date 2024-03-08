@section('title', "Users")
<div class="relative rounded-xl overflow-auto p-8">
    <div class="mb-4">
        <a href="{{ route('user-create') }}" class="btn btn-primary btn-lg" wire:navigate>Create a user</a>
    </div>

    <div class="overflow-x-auto">
        <table class="border-collapse border">
            <!-- head -->
            <thead>
            <tr>
                <th class="p-4 border">Id</th>
                <th class="p-4 border">Name</th>
                <th class="p-4 border">Email</th>
                <th class="p-4 border"></th>
            </tr>
            </thead>
            <tbody>
            @if(count($users) === 0)
                <tr>
                    <td colspan="3" class="p-4 border">There are no users</td>
                </tr>
            @else
                @foreach($users as $user)
                    <tr>
                        <td class="p-4 border">{{ $user->id }}</td>
                        <td class="p-4 border">{{ $user->name }}</td>
                        <td class="p-4 border">{{ $user->email }}</td>
                        <td class="p-4 border">
                            @if(!$user->isAdmin())
                                <a href="{{ route('user-edit', ['id' => $user->id]) }}" class="btn btn-success" wire:navigate>Edit</a>
                                <button wire:click="delete({{ $user->id }})" wire:confirm="Are you sure you want to delete this user?" class="btn btn-error">Delete</button>
                                <a href="{{ route('favorites', ['id' => $user->id]) }}" class="btn btn-primary" wire:navigate>Show favorites</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

        <div class="float-right m-8">
            {{ $users->links() }}
        </div>
    </div>
</div>
