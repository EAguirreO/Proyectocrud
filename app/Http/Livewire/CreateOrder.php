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

    protected $messages = [
        'direccion.required' => 'El campo dirección es requerido.',
        'referencia.required' => 'El campo referencia es requerido.',
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

        $order_bd = GeneralOrder::where([['id_usuario', auth()->user()->id], ['estado','PENDIENTE']])->get();

        if(count($order_bd) !== 0){
            $aux = $order_bd[0];
            $aux->direccion = $this->direccion;
            $aux->referencia = $this->referencia;
            $aux->departamento = $this->selectedDepartamento;
            $aux->provincia = $this->selectedProvincia;
            $aux->distrito = $this->selectedDistrito;
            $aux->save();
            $id_orden = $aux->id;
            session(['id_orden' => $id_orden]);
        } else {
            $general_order = new GeneralOrder();
            $general_order->id_usuario = auth()->user()->id;
            $general_order->direccion = $this->direccion;
            $general_order->referencia = $this->referencia;
            $general_order->departamento = $this->selectedDepartamento;
            $general_order->provincia = $this->selectedProvincia;
            $general_order->distrito = $this->selectedDistrito;
            $general_order->estado = 'PENDIENTE';
            $general_order->save();
            $id_orden = $general_order->id;
            session(['id_orden' => $id_orden]);
        }


        $this->reset(['direccion', 'referencia', 'selectedDepartamento', 'selectedProvincia', 'selectedDistrito']);
        $this->provincias = collect();
        $this->distritos = collect();
        
        
    }

}
