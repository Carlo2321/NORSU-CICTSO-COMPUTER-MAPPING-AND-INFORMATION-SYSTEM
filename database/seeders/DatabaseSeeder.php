<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Database\Seeders\ActivitySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ActivitySeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        $user1 = User::factory()->create([
            'role' => 'NetworkAdmin',
            'userName' => 'NetworkAdmin',
        ]);
        User::factory()->create([
            'role' => 'Admin',
            'userName' => 'Admin',
        ]);
        $role = Role::create([
            'name' => 'NetworkAdmin',
            'guard_name' => 'web',
        ]);
        $user1->assignRole($role);
    }
}
