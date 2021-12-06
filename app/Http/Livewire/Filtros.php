<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class Filtros extends Component
{

    public function store($product_id, $product_name, $product_price){
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Producto agregado al carrito');
        return redirect()->route('product.cart');
    }

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $categoria, $subcategoria;
    public $selectedCategory = null, $selectedSubcategory = null;
    protected $queryString = ['categoria', 'subcategoria', 'page'];

    public $subcategorias = null;

    public function mount(){
        if($this->categoria != null){
            $aux = Category::where('slug', $this->categoria)->get();

            $this->selectedCategory = $aux[0]->id;
            $this->updatedselectedCategory($aux[0]->id);

        }
        if($this->subcategoria != null){
            $aux2 = Subcategory::where('slug', $this->subcategoria)->get();
            $this->selectedSubcategory = $aux2[0]->id;
        }
    }

    public function render()
    {
        $productos = Product::paginate(4);

        if($this->selectedSubcategory != ''){
            $productos = Product::where('subcategoria', $this->selectedSubcategory)->paginate(4);
        }

        return view('livewire.filtros', [
            'categorias' => Category::all(),
            'productos' => $productos
        ])->layout('layouts.base');
    }

    public function updatedselectedCategory($category_id){
        if($category_id != ''){
            $this->categoria = Category::find($category_id)->slug;

            $this->subcategorias = Subcategory::where('categoria', $category_id)->get();
            $this->selectedSubcategory = '';
            // $this->resetPage();
        }
    }

    public function updatedselectedSubcategory($subcategory_id){
        $this->subcategoria = Subcategory::find($subcategory_id)->slug;
        $this->resetPage();
    }

    public function redireccionarVistaProductoDetalle($variable_id){
        return redirect()->route('vistaDetalleProducto', [$variable_id]);
    }
}
