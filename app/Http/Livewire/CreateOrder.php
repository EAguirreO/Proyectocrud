<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\District;
use App\Models\GeneralOrder;
use App\Models\Province;
use Livewire\Component;

class CreateOrder extends Component
{

    public $direccion, $referencia;
    public $departamentos, $provincias, $distritos;
    public $selectedDepartamento = NULL, $selectedProvincia = NULL, $selectedDistrito = NULL;

    protected $rules = [
        'direccion' => 'required',
        'referencia' => 'required',
    ];

    public function mount(){
        $this->departamentos = Department::all();
        $this->provincias = collect();
        $this->distritos = collect();
    }

    public function render()
    {
        return view('livewire.create-order')->layout('layouts.base');
    }

    public function updatedSelectedDepartamento($department_id){

        $this->provincias = Province::where('departamento', $department_id)->get();
        $this->selectedProvincia = NULL;
       
    }

    public function updatedSelectedProvincia($provincia_id){
        if(!is_null($provincia_id)){

            $this->distritos = District::where('provincia', $provincia_id)->get();
            $this->selectedDistrito = NULL;

        }
    }

    public function save(){
        $this->validate();

        GeneralOrder::create([
            'direccion'=>$this->direccion,
            'referencia'=>$this->referencia,
            'departamento'=>$this->selectedDepartamento,
            'provincia'=>$this->selectedProvincia,
            'distrito'=>$this->selectedDistrito
        ]);

        $this->reset(['direccion', 'referencia']);
        $this->emitTo('','');
    }

}
