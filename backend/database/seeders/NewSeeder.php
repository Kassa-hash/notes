<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class NewSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        Permission::firstOrCreate(['name' => 'inscription etudiants', 'guard_name' => 'api']);
        Permission::firstOrCreate(['name' => 'gérer utilisateurs', 'guard_name' => 'api']);
        Permission::firstOrCreate(['name' => 'inscription enseignants', 'guard_name' => 'api']);
        Permission::firstOrCreate(['name' => 'CRUD notes', 'guard_name' => 'api']);
        Permission::firstOrCreate(['name' => 'read notes', 'guard_name' => 'api']);

        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
        $enseignant = Role::firstOrCreate(['name' => 'enseignant', 'guard_name' => 'api']);
        $etudiant = Role::firstOrCreate(['name' => 'etudiant', 'guard_name' => 'api']);

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