<?php

namespace App\Livewire\SuperAdmin;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Usuarios extends Component
{
    public $open = false;
    public $name;
    public $role;
    public $email;

    public function cambiar()
    {
        $this->open = true;
    }

    public function store()
    {
        try {
            User::create([
                'name' => $this->name,
                'email' => $this->email
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $this->open = false;
    }
    public function render()
    {
        $user = User::all();
        $rol = Role::all('id', 'name');
        $permisos = Permission::get('id', 'name');
        return view(
            'livewire.super-admin.usuarios',
            [
                'user' => $user,
                'roles' => $rol,
                'permisos' => $permisos,
            ]
        );
    }
}
