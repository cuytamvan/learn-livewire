<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Auth;

class Login extends Component
{
    public $form = [
        'email' => '',
        'password' => '',
    ];

    public $msg = '';

    public function submit(){
        $this->validate([
            'form.email' => 'required|email',
            'form.password' => 'required',
        ]);

        $check = Auth::attempt($this->form, false);
        if($check){
            return redirect()->route('home');
        }

        session()->flash('message', [
            'message' => 'Incorrect email or password',
            'color' => 'danger',
        ]);
    }

    public function render()
    {
        return view('livewire.login');
    }
}
