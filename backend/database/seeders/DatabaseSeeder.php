<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First create roles and permissions
        $this->call(RolesAndPermissionsSeeder::class);

        // Then create users and assign roles
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test2@example.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('admin');

        $user2 = User::factory()->create([
            'name' => 'Enseignant User',
            'email' => 'enseignant@example.com',
            'password' => bcrypt('password'),
        ]);

        $user2->assignRole('enseignant');
    }
}
