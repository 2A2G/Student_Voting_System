<?php

namespace App\Livewire\Diagramas;

use App\Models\User;
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
                $rolesPaginated = Role::paginate(10, ['id', 'name']);
                $this->data = $rolesPaginated->items();  // Solo los datos de la página actual
                $this->dataI = ['id', 'name'];
                $this->columns = ['ID', 'Nombre del Rol'];
                break;
            case 'permisos':
                $permissionsPaginated = Permission::paginate(10, ['id', 'name']);
                $this->data = $permissionsPaginated->items();  // Solo los datos de la página actual
                $this->dataI = ['id', 'name'];
                $this->columns = ['ID', 'Nombre del Permiso'];
                break;

            case 'usuarios':
                $usuariosPaginate = User::paginate(10, ['id', 'name', 'email']);
                $this->data = $usuariosPaginate->items();
                $this->dataI = ['id', 'name', 'email'];
                $this->columns = ['ID', 'Nombre Completo', 'Correo Electronico', 'Rol', 'Acción'];
                break;

            // case 'descargas':

            //     break;

            default:
                $defaultPaginated = Role::paginate(10, ['id', 'name']);
                $this->data = $defaultPaginated->items();  // Solo los datos de la página actual
                $this->dataI = ['id', 'name'];
                $this->columns = ['ID', 'Nombre del Rol'];
                break;
        }

        // Devolver la colección paginada completa para la vista
        return $rolesPaginated ?? $permissionsPaginated ?? $usuariosPaginate ?? $defaultPaginated;
    }



    public function mount($columns = [], $data = [])
    {
        $this->datos();
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
