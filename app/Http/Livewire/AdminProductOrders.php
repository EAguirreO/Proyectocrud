<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductOrder;
use Livewire\Component;

class AdminProductOrders extends Component
{
    public $id_Orden;
    public $producto;
    

    public function mount($id){
        $this->id_Orden = $id;
        
        $this->producto = new Product();
    }

    public function render()
    {
        return view('livewire.admin-product-orders', ['product_orders' => ProductOrder::where('id_orden_general', $this->id_Orden)->paginate(2), 'producto'=> $this->producto]);
    }
}
