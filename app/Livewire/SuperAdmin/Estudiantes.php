<?php

namespace App\Livewire\SuperAdmin;

use App\Models\Curso;
use App\Models\Estudiante;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Estudiantes extends Component
{

    #[Validate('required')]
    #[Validate("Unique:estudiantes,numeroIdentidad")]

    public $open = false;

    public $numeroIdentidad;
    public $nombreEstudiante;
    public $apellidoEstudiante;
    public $sexo = '';
    public $curso_id = '';

    public function clearInput()
    {
        $this->numeroIdentidad = '';
        $this->nombreEstudiante = '';
        $this->apellidoEstudiante = '';
        $this->sexo = '';
        $this->curso_id = '';
    }


    public function store()
    {
        $this->validate();
        $estudiante = new Estudiante();
        $estudiante->numeroIdentidad = $this->numeroIdentidad;
        $estudiante->nombreEstudiante = $this->nombreEstudiante;
        $estudiante->apellidoEstudiante = $this->apellidoEstudiante;
        $estudiante->sexo = $this->sexo;
        $estudiante->curso_id = $this->curso_id;
        $estudiante->save();
        $this->dispatch('post-created', name: "El estudiante " . $this->nombreEstudiante . ", creado satisfactoriamente");
        $this->clearInput();
        $this->open = false;
    }

    public function cambiar()
    {
        $this->open = true;
    }
    public function render()
    {

        $totalEstudiantes = Estudiante::all();
        $cursos = Curso::all();
        return view('livewire.super-admin.estudiantes', [
            'totalEstudiantes' => $totalEstudiantes,
            'cursos' => $cursos
        ]);
    }
}
