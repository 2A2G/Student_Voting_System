<?php

namespace App\Livewire\SistemaVotacion;

use App\Models\Cargo;
use Livewire\Component;

class Cargos extends Component
{

    public $open = false;
    public $nombreCargo;
    public $descripcionCargo;

    public function clearInput()
    {
        $this->nombreCargo = '';
        $this->descripcionCargo = '';
    }

    public function cambiar()
    {
        $this->open = true;
    }

    public function store()
    {
        $this->validate(
            [
                'nombreCargo' => 'required',
                'descripcionCargo' => 'required'
            ]
        );

        Cargo::create(
            [
                'nombreCargo' => $this->nombreCargo,
                'descripcionCargo' => $this->descripcionCargo
            ]
        );

        $this->dispatch('post-created', name: "El cargo " . $this->nombreCargo . ", creado satisfactoriamente");
        $this->clearInput();
        $this->open = false;
    }



    public function render()
    {
        $cargos = Cargo::count();
        return view(
            'livewire.sistema-votacion.cargos',
            [
                'cargos' => $cargos
            ]
        );
    }
}
