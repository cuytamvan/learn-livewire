<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $title = 'Home';

    public function render(){
        return view('livewire.home');
    }
}
