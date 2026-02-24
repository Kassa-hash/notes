<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'inscription etudiants']);
        Permission::create(['name' => 'gérer utilisateurs']);
        Permission::create(['name' => 'inscription enseignants']);
        Permission::create(['name' => 'CRUD notes']);
        Permission::create(['name' => 'read notes']);


        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('inscription etudiants');
        $admin->givePermissionTo('gérer utilisateurs');
        $admin->givePermissionTo('inscription enseignants');

        $enseignant = Role::create(['name' => 'enseignant']);
        $enseignant->givePermissionTo('CRUD notes');

        $etudiant = Role::create(['name' => 'etudiant']);
        $etudiant->givePermissionTo('read notes');

        
    }
}
