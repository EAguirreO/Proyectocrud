<?php

namespace App\Http\Livewire;

use App\Models\Subcategory;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateSubcategory extends Component
{

    public $open = false;

    public $nombre, $cat, $orden, $categorias;

    protected $rules = [
        'nombre' => 'required',
        'orden' => 'required',
        'cat' => 'required'
    ];

    public function mount(){
        $this->categorias = Category::all();
    }

    public function save(){

        
        $this->validate();

        Subcategory::create([
            'nombre' => $this->nombre,
            'orden' => $this->orden,
            'categoria' => $this->cat,
            'estado' => 'Activo',
            'slug' => Str::slug($this->nombre, '-')
        ]);

        $this->reset(['open','nombre','orden','cat']);

        $this->emitTo('subcategorias','render');
        $this->emit('alert', 'Subcategoría creada exitosamente');
        
    }

    public function render()
    {
        return view('livewire.create-subcategory');
    }
}
