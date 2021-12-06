<?php

namespace App\Http\Livewire;

use App\Models\GeneralOrder;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrders extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $idOrden = 0;

    public function render()
    {
        return view('livewire.admin-orders',['ordenes'=>GeneralOrder::paginate(2)]);

    }

    public function actualizarId($id){
        $this->idOrden = $id;
        return redirect()->route('admin.product.orders', [$this->idOrden]);
    }
}
