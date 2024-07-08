<?php

namespace App\Livewire\SistemaVotacion;

use App\Models\Cargo;
use App\Models\Curso;
use App\Models\Estudiante; // Asegúrate de tener el modelo Estudiante
use App\Models\Postulante;
use Livewire\Component;

use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;


class Postulacion extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    #[Validate("unique:estudiantes,numeroIdentidad")]

    public $open = false;
    public $numeroIdentidad;
    public $nombrePostulante;
    public $cargo;
    public $imagen;

    public $cursoPostulante;
    public $mensajeError;

    public function clearInput()
    {
        $this->numeroIdentidad = '';
        $this->cargo = '';
        $this->cursoPostulante = '';
        $this->nombrePostulante = '';
        $this->mensajeError = '';
    }

    public function cambiar()
    {
        $this->open = true;
        $this->clearInput();
    }

    public function buscarEstudiante()
    {
        $estudiante = Estudiante::where('numeroIdentidad', $this->numeroIdentidad)->first();

        if ($estudiante) {
            $this->nombrePostulante = $estudiante->nombreEstudiante;
            $this->cursoPostulante = $estudiante->curso->nombreCurso;
            $this->mensajeError = '';

            if ($estudiante->curso->nombreCurso === 'Decimo') {
                $this->cargo = 'Contralor';
            }
            if ($estudiante->curso->nombreCurso === 'Undecimo') {
                $this->cargo = 'Personero';
            } else {
                $this->cargo = 'Representante de curso';
            }
            if (Postulante::where('estudiante_id', $estudiante->id)->first()) {
                $this->mensajeError = 'Este estudiante ya se encuentra postulado';
                return;
            }
            $this->dispatch('estudiante-encontrado', $estudiante,$this->imagen);
        } else {
            $this->nombrePostulante = '';
            $this->cursoPostulante = '';
            $this->cargo = '';
            $this->mensajeError = 'No existe ningún estudinate con este  número de identidad';
        }
    }

    
    public function updatedImagen($propertys){
        $this->dispatch('upload-image', $propertys->temporaryUrl());
        // dd($this->imagen);

    }

    public function store()
    {
        $this->validate([
            'numeroIdentidad' => 'required'
        ]);

        $newPostulante = Estudiante::where('numeroIdentidad', $this->numeroIdentidad)->first();

        $cursoPostulante = $newPostulante->curso_id;

        if ($cursoPostulante === 1 || $cursoPostulante < 10) {
            $this->cargo = 'Representante de Curso';

        } elseif ($cursoPostulante === 10) {
            $this->cargo = 'Contralor';

        } else {
            $this->cargo = 'Personero';
        }

        Postulante::create([
            'estudiante_id' => $newPostulante->id,
            'cargo_id' => Cargo::where('nombreCargo', $this->cargo)->first()->id
        ]);


        $this->dispatch('post-created', name: "La postulación de " . $newPostulante->nombreEstudiante . ", para el cargo de " . $this->cargo . " ha sido creada satisfactoriamente");

        $this->open = false;
        $this->clearInput();
    }

    public function render()
    {
        $cursos = Curso::all();
        $cargos = Cargo::all();
        $totalPostulantes = Postulante::count();
        return view(
            'livewire.sistema-votacion.postulacion',
            [
                'cursos' => $cursos,
                'cargos' => $cargos,
                'totalPostulantes' => $totalPostulantes
            ]
        );
    }
}
