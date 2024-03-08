<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public User $user;

    #[Validate]
    public $name = '';
    public $email = '';
    #[Validate]
    public $password = '';

    public $id;

    public function render()
    {
        return view('livewire.user.create')->layout('layouts.app');
    }

    public function mount()
    {
        $this->user = User::find($this->id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function save()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : $this->user->password
        ]);

        $this->redirectRoute('users', [], true, true);
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)]
        ];
    }
}
