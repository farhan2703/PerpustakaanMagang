<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);

        $viewPostsPermission = Permission::create(['name' => 'view posts']);
        $editPostsPermission = Permission::create(['name' => 'edit posts']);

        // Assign role and permission to a user
        $user = \App\Models\User::find(1);
        $user->assignRole('admin');
        $user->givePermissionTo('edit posts');
    }
}