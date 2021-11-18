<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Cart;

class ProductDetail extends Component
{
    public $identificador;
    public $producto;
    public $productos_relacionados;
    public $url_imagen;

    protected $listeners = ['cambiarImagen'];

    public function mount($id){
        $this->identificador = $id;
        $this->producto = Product::find($id);
        $this->productos_relacionados = Product::where('subcategoria', $this->producto->subcategoria)->orderByRaw("RAND()")->limit(4)->get();
        $this->url_imagen = $this->producto->imagen;
        // dd($this->productos_relacionados);
    }

    public function store($product_id, $product_name, $product_price){
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Product agregado al carrito');
        return redirect()->route('product.cart');
    }

    public function render()
    {
        return view('livewire.product-detail')->layout('layouts.base');
    }

    public function redireccionarVistaProductoDetalle($variable_id){
        // dd($variable_id);
        return redirect()->route('vistaDetalleProducto', [$variable_id]);
    }

    public function redireccionarVistaCatalogo(){
        return redirect()->route('vistaCatalogo');
    }

    public function cambiarImagen($dato){
        // dd($direccion);
        $this->url_imagen = $dato;
        // $this->emit('render');
    }
}
