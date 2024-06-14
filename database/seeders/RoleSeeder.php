<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Rol1 = Role::create(['name' => 'super-admin']);
        $Rol2 = Role::create(['name' => 'admin']);
        $Rol2 = Role::create(['name' => 'docente']);
        $Rol2 = Role::create(['name' => 'estudiante']);
        $Rol2 = Role::create(['name' => 'invitado']);




        Permission::create(['name' => 'create user'])->asyncRole($Rol1);
        Permission::create(['name' => 'edit user'])->asyncRole($Rol1);


    }
}
