<?php

namespace App\Livewire\Diagramas;

use App\Models\Cargo;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Postulante;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
                $usuariosPaginate = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                    ->select('users.id', 'users.name', 'users.email', 'roles.name as role')
                    ->simplePaginate(10);

                $this->data = $usuariosPaginate->items();
                $this->dataI = ['id', 'name', 'email', 'role'];
                $this->columns = ['ID', 'Nombre del Usuario', 'Correo Electrónico', 'Rol', 'Acción'];
                break;

            case 'estudiantes':
                $estudiantesPaginate = Estudiante::join('cursos', 'estudiantes.curso_id', '=', 'cursos.id')
                    ->select(
                        'estudiantes.id',
                        'estudiantes.numero_identidad',
                        'estudiantes.nombre_estudiante',
                        'estudiantes.sexo',
                        'cursos.nombre_curso as curso'
                    )
                    ->simplePaginate(10);

                $this->data = $estudiantesPaginate->items();
                $this->dataI = ['id', 'numero_identidad', 'nombre_estudiante', 'sexo', 'curso'];
                $this->columns = ['ID', 'Número de Identidad', 'Nombre del Estudiante', 'Sexo', 'Curso', 'Acción'];
                break;

            case 'docentes':
                $docentesPaginate = Docente::leftJoin('cursos', 'docentes.curso_id', '=', 'cursos.id')
                    ->select(
                        'docentes.id',
                        'docentes.numero_identidad',
                        'docentes.asignatura',
                        'docentes.sexo',
                        DB::raw('COALESCE(cursos.nombre_curso, \'No\') AS curso')
                    )
                    ->simplePaginate(10);

                $this->data = $docentesPaginate->items();
                $this->dataI = ['id', 'numero_identidad', 'asignatura', 'sexo', 'curso'];
                $this->columns = ['ID', 'Número de Identidad', 'Nombre de la asignatura', 'Sexo', 'Director del Curso', 'Acción'];
                break;

            case 'postulantes':
                $postulantesPaginate = Postulante::join('estudiantes', 'postulantes.estudiante_id', '=', 'estudiantes.id')
                    ->join('cargos', 'postulantes.cargo_id', '=', 'cargos.id')
                    ->join('cursos', 'estudiantes.curso_id', '=', 'cursos.id')

                    ->select(
                        'postulantes.id',
                        'estudiantes.nombre_estudiante as estudiantes',
                        'cursos.nombre_curso as cursos',
                        'cargos.nombre_cargo as cargos'
                    )
                    ->simplePaginate(10);

                $this->data = $postulantesPaginate->items();
                $this->dataI = ['id', 'estudiantes', 'cursos', 'cargos'];
                $this->columns = ['id', 'estudiante', 'curso', 'cargo', 'accion'];
                break;

            case 'cargos':
                $cargosPaginate = Cargo::simplePaginate(10, ['id', 'nombre_cargo', 'descripcion_cargo']);
                $this->data = $cargosPaginate->items();
                $this->dataI = ['id', 'nombre_cargo', 'descripcion_cargo'];
                $this->columns = ['id', 'Nombre del cargo', 'Descripcion del cargo', 'accion'];
                break;

            case 'anio_postulacion':
                $postulacionAnios = Postulante::simplePaginate(10, ['id', 'anio_postulacion']);
                $this->data = $postulacionAnios->items();
                $this->dataI = ['id', 'anio_postulacion'];
                $this->columns = ['id', 'Año de postulación', 'accion'];
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
            ?? $docentesPaginate ?? $cargosPaginate ?? $postulantesPaginate ?? $postulacionAnios ?? null;
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
