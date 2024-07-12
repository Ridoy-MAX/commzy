<?php

namespace Database\Seeders;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a default user
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Hash the password
        ]);

        // Assign the super-admin role to the user
        $superAdminRole = Role::where('name', 'super-admin')->first();
        $user->assignRole($superAdminRole);
    }
}
