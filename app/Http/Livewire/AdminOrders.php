<?php

namespace App\Http\Livewire;

use App\Models\GeneralOrder;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrders extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $idOrden = 0;

    public function render()
    {
        Session::put('url_anterior', request()->fullUrl());
        return view('livewire.admin-orders',['ordenes'=>GeneralOrder::paginate(2)]);

    }

    public function actualizarId($id){
        $this->idOrden = $id;
        return redirect()->route('admin.product.orders', [$this->idOrden]);
    }

    public function formatFecha($fechaOriginal){
        $fechaEdit = substr($fechaOriginal, 0, 10);
        $dia=substr($fechaEdit, 8, 2);
        $mes=substr($fechaEdit, 5, 2);
        $anio=substr($fechaEdit, 0, 4);
        return $dia . '-' . $mes . '-' . $anio; 
    }
}
