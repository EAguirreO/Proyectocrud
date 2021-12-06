<?php

namespace App\Http\Livewire;

use App\Models\GeneralOrder;
use Livewire\Component;
use Livewire\WithPagination;

class UserOrders extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $idOrden = 0, $idUsuario;

    public function mount(){
        $this->idUsuario = auth()->user()->id;
    }

    public function render()
    {

        return view('livewire.user-orders', 
            ['ordenes' => GeneralOrder::where('id_usuario', $this->idUsuario)->paginate(2)]
        )->layout('layouts.base');
    }

    public function actualizarId($id){
        $this->idOrden = $id;
        return redirect()->route('user.order.details', [$this->idOrden]);
        // $this->dispatchBrowserEvent('abrirExampleModal');
        // $this->emitTo('actualizar', $this->idOrden);
    }
}
