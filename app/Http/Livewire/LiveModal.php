<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveModal extends Component
{
    public $showModal = 'hidden';

    protected $listeners = [
        'showModal'
    ];

    public function render()
    {
        return view('livewire.live-modal');
    }

    public function showModal($category){
        // dd($category);
        $this->showModal='';
    }

    public function cerrarModal(){
        $this->showModal = 'hidden';
    }
}
