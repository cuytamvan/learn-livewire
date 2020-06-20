<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\User;

use Hash;

class Register extends Component
{
    public $form = [
        'name'                  => '',
        'email'                 => '',
        'password'              => '',
        'password_confirmation' => '',
    ];

    public function submit(){
        $this->validate([
            'form.name' => 'required',
            'form.email' => 'required|email',
            'form.password' => 'required|confirmed',
        ]);

        $input = $this->form;
        $input['password'] = Hash::make($input['password']);

        User::create($input);
        return redirect()->route('login');
    }

    public function render(){
        return view('livewire.register');
    }
}
