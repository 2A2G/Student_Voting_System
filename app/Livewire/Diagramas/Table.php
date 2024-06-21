<?php

namespace App\Livewire\Diagramas;

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
            case ('roles'):
                $this->data = Role::get(['id', 'name']);
                $this->dataI = ['id', 'name'];

                $this->columns = ['ID', 'Nombre del permiso'];
                break;
            case ('permisos'):
                $this->data = Permission::get(['id', 'name']);
                $this->dataI = ['id', 'name'];

                $this->columns = ['ID', 'Nombre del permiso',];
                break;
            default:
                $this->data = collect(Role::get(['id', 'name']));
                $this->dataI = ['id', 'name'];

                $this->columns = ['ID', 'Nombre del permiso',];
                break;

        }


    }


    public function mount($columns = [], $data = [])
    {
        $this->datos();

    }

    public function render()
    {
        return view('livewire.diagramas.table');
    }
}
