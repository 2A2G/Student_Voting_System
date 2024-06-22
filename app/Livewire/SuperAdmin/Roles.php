<?php

namespace App\Livewire\SuperAdmin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $open = false;
    public $name;
    public $role;

    public function cambiar($name)
    {
        $this->name = $name;

        if ($name === 'permiso') {
            $this->role = 'permiso';
        }

        if ($name === 'rol') {
            $this->role = 'rol';
        }

        $this->open = true;
    }

    public function crear()
    {
        if ($this->name === 'permiso') {
            Permission::create([
                'name' => $this->role,
            ]);
        } elseif ($this->name === 'rol') {
            Role::create([
                'name' => $this->role,
            ]);
        }

        $this->open = false;
    }



    public function render()
    {
        $totalRoles = Role::count();
        $totalPermisos = Permission::count();

        // Pasa estos datos a la vista
        return view('livewire.super-admin.roles', [
            'totalRoles' => $totalRoles,
            'totalPermisos' => $totalPermisos
        ]);
    }
}
