<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\SupportTicket;

class Tickets extends Component
{
    public $active = 1;
    protected $listeners = [
        'ticketSelected', // amun boga emit jeung fungsi nu sama, bisa di deklarasi keun kos kieu
    ];

    public function ticketSelected($id){
        $this->active = $id;
    }

    public function render()
    {
        $data = SupportTicket::all();
        return view('livewire.tickets', [
            'tickets' => $data
        ]);
    }
}
 