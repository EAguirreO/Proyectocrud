<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateCategory extends Component
{

    public $open = false;

    public $nombre, $orden;

    protected $rules = [
        'nombre' => 'required',
        'orden' => 'required',
    ];

    public function save(){

        $this->validate();

        Category::create([
            'nombre' => $this->nombre,
            'orden' => $this->orden,
            'estado' => 'Activo',
            'slug' => Str::slug($this->nombre, '-')
        ]);

        $this->reset(['open','nombre','orden']);

        $this->emitTo('categorias','render');
        $this->emit('alert', 'Categoría creada exitosamente');
    }

    public function render()
    {
        return view('livewire.create-category');
    }
}
