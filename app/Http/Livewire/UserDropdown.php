<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserDropdown extends Component
{

    // protected $listeners = ['actualizar' => '$refresh'];

    public function render()
    {
        return view('livewire.user-dropdown');
    }

    public function logout(){
        auth('web')->logout();
        // Auth::logout();
        return redirect()->route('vistaCatalogo');
    }
}
