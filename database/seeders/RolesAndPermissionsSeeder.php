<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Define roles
        $roles = [
            [
                'name' => 'Super-Admin',
            ],
            [
                'name' => 'Editor',
            ],
        ];

        // Define permissions
        $permissions = [
            'Dashboard' => [
                'Dashboard Cards',
                'Dashboard Charts',
                'Dashboard Pie Charts',
            ],
            'Admin' => [
                'All Admins',
                'Create Admin',
                'Edit Admin',
                'Show Admin',
                'Delete Admin',
            ],
            'User' => [
                'All Users',
                'Create User',
                'Edit User',
                'Show User',
                'Delete User',
            ],
            'Role' => [
                'All Roles',
                'Create Role',
                'Edit Role',
                'Delete Role',
            ],
        ];

        // Create roles
        foreach ($roles as $role) {
            Role::create($role);
        }

        // Create permissions and assign them to respective roles
        foreach ($permissions as $parent => $childs) {
            $parentPermission = Permission::create(['name' => $parent]);
            foreach ($childs as $child) {
                Permission::create([
                    'parent_id' => $parentPermission->id,
                    'name' => $child,
                ]);
            }
        }

        // Retrieve the "Admin" role
        $adminRole = Role::where('name', 'Super-Admin')->first();

        // Assign the "Admin" role to a user
        $user = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email'             => 'admin@app.com',
            'password'          => Hash::make('12345678'),
            'type'              => 'admin',
            'status'            => 'active',
            'phone'             => '+880 1381055093',
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);
        $user->assignRole($adminRole);

        // Retrieve all permissions
        $allPermissions = Permission::pluck('id')->toArray();

        // Sync all permissions with the "Admin" role
        $adminRole->syncPermissions($allPermissions);
    }
}
