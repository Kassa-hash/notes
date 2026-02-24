<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        Permission::firstOrCreate(['name' => 'inscription etudiants']);
        Permission::firstOrCreate(['name' => 'gérer utilisateurs']);
        Permission::firstOrCreate(['name' => 'inscription enseignants']);
        Permission::firstOrCreate(['name' => 'CRUD notes']);
        Permission::firstOrCreate(['name' => 'read notes']);

        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $enseignant = Role::firstOrCreate(['name' => 'enseignant']);
        $etudiant = Role::firstOrCreate(['name' => 'etudiant']);

        // Give permissions safely
        $admin->givePermissionTo([
            'inscription etudiants',
            'gérer utilisateurs',
            'inscription enseignants'
        ]);

        $enseignant->givePermissionTo('CRUD notes');
        $etudiant->givePermissionTo('read notes');
    }
}