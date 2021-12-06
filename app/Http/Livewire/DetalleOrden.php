<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductOrder;
use Livewire\Component;

class DetalleOrden extends Component
{

    public $id_Orden;
    public $producto;
    // protected $listeners = ['actualizar'];

    public function mount($id){
        $this->id_Orden = $id;
        // $this->producto = Product::all();
        $this->producto = new Product();
    }
    
    public function render()
    {
        // sleep(10);
        // $producto = new Product();
        // $producto = $this->producto::all();
        // $producto = $this->producto::all();
        // dd($producto);

        return view('livewire.detalle-orden', ['product_orders' => ProductOrder::where('id_orden_general', $this->id_Orden)->paginate(2), 'producto'=> $this->producto])->layout('layouts.base');
    }

}
