<?php

namespace App\Livewire\Diagramas;

use App\Models\Cargo;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Postulante;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Table extends Component
{

    use WithPagination;

    public $columns = [];
    public $data, $dataI;

    public $roles;
    public $case;

    public function datos()
    {
        switch ($this->case) {
            case 'roles':
                $rolesPaginated = Role::simplePaginate(10, ['id', 'name']);
                $this->data = $rolesPaginated->items();  // Solo los datos de la página actual
                $this->dataI = ['id', 'name'];
                $this->columns = ['ID', 'Nombre del Rol', 'Acción'];
                break;

            case 'permisos':
                $permissionsPaginated = Permission::simplePaginate(10, ['id', 'name']);
                $this->data = $permissionsPaginated->items();  // Solo los datos de la página actual
                $this->dataI = ['id', 'name'];
                $this->columns = ['ID', 'Nombre del Permiso'];
                break;

            case 'usuarios':
                $usuariosPaginate = User::simplePaginate(10, ['id', 'name', 'email']);
                $this->data = $usuariosPaginate->items();
                $this->dataI = ['id', 'name', 'email'];
                $this->columns = ['ID', 'Nombre Completo', 'Correo Electronico', 'Rol', 'Acción'];
                break;

            case 'estudiantes':
                $estudiantesPaginate = Estudiante::simplePaginate(10, ['id', 'numeroIdentidad', 'nombreEstudiante', 'sexo', 'curso_id']);
                $this->data = $estudiantesPaginate->items();
                $this->dataI = ['id', 'numeroIdentidad', 'nombreEstudiante', 'sexo', 'curso_id'];
                $this->columns = ['ID', 'Número de Identidad', 'Nombre del Estudiante', 'Sexo', 'Curso', 'Acción'];
                break;

            case 'docentes':
                $docentesPaginate = Docente::simplePaginate(10, ['id', 'numeroIdentidad', 'asignatura', 'sexo', 'curso_id']);
                $this->data = $docentesPaginate->items();
                $this->dataI = ['id', 'numeroIdentidad', 'asignatura', 'sexo', 'curso_id'];
                $this->columns = ['ID', 'Número de Identidad', 'Nombre de la asignatura', 'Sexo', 'Director del Curso', 'Acción'];
                break;

            case 'postulantes':
                $postulantesPaginate = Postulante::join('estudiantes', 'postulantes.estudiante_id', '=', 'estudiantes.id')
                    ->join('cargos', 'postulantes.cargo_id', '=', 'cargos.id')
                    ->join('cursos', 'estudiantes.curso_id', '=', 'cursos.id')

                    ->select(
                        'postulantes.id',
                        'estudiantes.nombreEstudiante as estudiantes',
                        'cursos.nombreCurso as cursos',
                        'cargos.nombreCargo as cargos'
                    )
                    ->simplePaginate(10);

                $this->data = $postulantesPaginate->items();
                $this->dataI = ['id', 'estudiantes', 'cursos', 'cargos'];
                $this->columns = ['id', 'estudiante', 'curso', 'cargo', 'accion'];
                break;

            case 'cargos':
                $cargosPaginate = Cargo::simplePaginate(10, ['id', 'nombreCargo', 'descripcionCargo']);
                $this->data = $cargosPaginate->items();
                $this->dataI = ['id', 'nombreCargo', 'descripcionCargo'];
                $this->columns = ['id', 'Nombre del cargo', 'Descripcion del cargo', 'accion'];
                break;


            default:
                $defaultPaginated = Role::simplePaginate(10, ['id', 'name']);
                $this->data = $defaultPaginated->items();
                $this->dataI = ['id', 'name'];
                $this->columns = ['ID', 'Nombre del Rol', 'Acción'];
                break;
        }

        // Devolver la colección paginada completa para la vista
        return $rolesPaginated ?? $permissionsPaginated ?? $usuariosPaginate ?? $defaultPaginated ?? $estudiantesPaginate
            ?? $docentesPaginate ?? $cargosPaginate ?? $postulantesPaginate ?? null;
    }



    public function mount($columns = [], $data = [])
    {
        $this->datos();
    }


    #[On('post-created')]
    public function refresh()
    {
        $this->datos();
    }

    public function filtrar($case)
    {
        //
    }

    public function render()
    {
        $paginatedData = $this->datos();
        return view('livewire.diagramas.table', [
            'data' => $this->data,
            'pagination' => $paginatedData // Pasa la colección paginada completa
        ]);
    }
}
