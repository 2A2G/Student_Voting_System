<?php

namespace App\Livewire\SuperAdmin;

use App\Models\User;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Usuarios extends Component
{

    #[Validate('required')]
    #[Validate("Unique:users,name, users,email")]

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

        $this->validate();
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt('password');
        $user->save();

        $user->syncRoles([$this->role]);

        $this->dispatch('post-created', name: "El usuario " . $this->name . ", creado satisfactoriamente");
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
