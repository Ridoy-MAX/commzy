<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-users',
            'edit-users',
            'delete-users',
            'create-service',
            'info-users',
            'block-users',
            'edit-service',
            'delete-service',
            'site-settings',
            'manage-service',
            'category-list',
            'account-approval',
            'role-permission',
            'accept-proposal',
            'sent-proposal',
            'modify-proposal',
            'administration-power',
            'client',
            'seller',
        ];
        
        foreach ($permissions as $permission) {
            Permission::updateOrCreate([
                'name' => $permission,
                'guard_name' => 'web', // Change the guard_name if needed
            ]);
        }
        
    }
}