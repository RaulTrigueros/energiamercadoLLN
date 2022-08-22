<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleCombustible = Role::create(['name' => 'Combustible']);
        $roleAuxiliar = Role::create(['name' => 'Auxiliar']);

        //Permisos creados con Spatie
        Permission::create(['name' => 'gestionCompleta']);             
        Permission::create(['name' => 'verDashboard'])->syncRoles([$roleAdmin,$roleCombustible]);
        Permission::create(['name' => 'gestionCombustible'])->syncRoles([$roleAdmin,$roleCombustible,$roleAuxiliar]);
        Permission::create(['name' => 'gestionProyectos'])->assignRole($roleAdmin,$roleCombustible);
        Permission::create(['name' => 'gestionUsuarios'])->assignRole($roleAdmin);
        
        $roleAdmin->givePermissionTo(Permission::all());
    }
}
