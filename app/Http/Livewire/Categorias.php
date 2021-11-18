<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Categorias extends Component
{

    use WithPagination;
    public $showModal = 'hidden';
    public $category;
    public $open_edit = false;

    protected $listeners = ['render' => 'render', 'delete'];

    public function mount(){
        $this->category = new Category();
    }

    protected $rules = [
        'category.nombre' => 'required',
        'category.orden' => 'required',
        'category.estado' => 'required'
    ];


    public function render()
    {

        $categorias = Category::paginate(10);

        return view('livewire.categorias', [
            'categorias' => $categorias,
        ]);
    }

    // public function showModal(Category $category){
    //     // dd($category);
    //     $this->emit('showModal', $category);
    // }

    public function edit(Category $category){
        $this->category = $category;
        $this->open_edit = true;
    }

    public function update(){
        $this->validate();
        $this->category->slug = Str::slug($this->category->nombre, '-');
        $this->category->save();

        $this->reset(['open_edit']);

        $this->emit('alert', 'Categoría actualizada exitosamente');
    }

    public function delete(Category $category){
        $category->delete();
    }

}
