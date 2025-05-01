<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $users, $name, $favourite_color, $user_id;
    public $updateMode = false;
    protected $listeners = ['delete'];

    public function render()
    {
        $this->users = User::all();
        return view('livewire.users')->extends('layouts.app');
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->favourite_color = '';
    }

    public function store()
    {
        $validated = $this->validate([
            'name' => 'required|unique:users,name',
            'favourite_color' => 'required',
        ]);

        $validated['email'] = strtolower($this->name) . '@example.com'; // Set email in backend
        $validated['password'] = bcrypt('password'); // Set a default password

        User::create($validated);
        $this->resetInputFields();
        session()->flash('message', 'User Created Successfully.');
        $this->dispatch('closeModal', ['modal' => '#userModal']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->favourite_color = $user->favourite_color;
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
        $this->dispatch('closeModal', ['modal' => '#userModal']);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|unique:users,name,' . $this->user_id,
            'favourite_color' => 'required',
        ]);

        if ($this->user_id) {
            $user = User::find($this->user_id);
            $user->update([
                'name' => $this->name,
                'email' => strtolower($this->name) . '@example.com', // Update email in backend
                'favourite_color' => $this->favourite_color,
            ]);
            $this->updateMode = false;
            $this->resetInputFields();
            session()->flash('message', 'User Updated Successfully.');
            $this->dispatch('closeModal', ['modal' => '#userModal']);
        }
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User Deleted Successfully.');
    }
}
