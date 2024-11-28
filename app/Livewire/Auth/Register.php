<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $name, $email, $password;

    public function register()
    {
        logger('enters register');
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        logger('validates');

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        logger('creates user');

        auth()->login($user); // Automatically log the user in
        logger('logs in');
        return redirect('/listing'); // Redirect to a secure page

        //dd('Register function called!');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
