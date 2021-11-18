<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class EditCategory extends Component
{

    public $open = false;
    public $category;

    protected $rules = [
        'category.nombre' => 'required',
        'category.orden' => 'required',
        'category.estado' => 'required'
    ];

    public function mount(Category $category){
        $this->category = $category;
    }

    public function save(){
        $this->validate();
        $this->category->save();

        $this->reset(['open']);

        $this->emitTo('categorias', 'render');

        $this->emit('alert', 'Categoría actualizada exitosamente');
    }

    public function render()
    {
        return view('livewire.edit-category');
    }
}
