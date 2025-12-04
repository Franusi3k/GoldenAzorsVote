<?php

namespace Database\Seeders;

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
        $permissions = [
            //
        ];

        //creating permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        //creating roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        //assigning permissions to roles
        $admin->givePermissionTo($permissions);
    }
}
