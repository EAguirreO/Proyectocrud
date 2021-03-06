<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    // public $products;

    // public function mount(){
    //     $this->products = [];
    // }

    protected $listeners = ['refrescarComponent' => '$refresh'];

    public function increaseQuantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');
        // $this->emitTo('cart-count-component', 'refreshComponent');
        // $this->emitSelf('refrescarComponent');
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function decreaseQuantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');
        // $this->emitSelf('refrescarComponent');
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function destroy($rowId){
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component', 'refreshComponent');
        Session()->flash('success_message', 'El producto fue eliminado');
    }

    public function destroyAll(){
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
