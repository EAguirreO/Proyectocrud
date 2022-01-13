<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductOrders extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

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

    // public function regresar(){
    //     echo Session::get('url_anterior');
    //     // return back();
    // }
}
