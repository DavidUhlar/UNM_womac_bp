<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions_all = Permission::get();
        //read permission from route
        $permissions = [];
        $permissions_admin = [];
        foreach($permissions_all as $permission) {
            $_p = explode(".", $permission->name)[0];
            $permissions_admin[$permission->name] = $permission->name;
            if (in_array($_p, ['permissions', 'roles'])) {

                continue;
            }

            $permissions[$permission->name] = $permission->name;
        }


        //admin
        if (Role::where('name', 'admin')->exists()) {
            $role = Role::where('name', 'admin')->first();
        } else {
            $role = Role::create(['name' => 'admin']);
        }
        $role->syncPermissions($permissions_admin);

        //superuser
        if (Role::where('name', 'superuser')->exists()) {
            $role = Role::where('name', 'superuser')->first();
        } else {
            $role = Role::create(['name' => 'superuser']);
        }
        $role->syncPermissions($permissions);

        //investigatior
        if (Role::where('name', 'investigator')->exists()) {
            $role = Role::where('name', 'investigator')->first();
        } else {
            $role = Role::create(['name' => 'investigator']);
        }
        $role->syncPermissions($permissions);

        //operator
        if (Role::where('name', 'operator')->exists()) {
            $role = Role::where('name', 'operator')->first();
        } else {
            $role = Role::create(['name' => 'operator']);
        }
        $role->syncPermissions($permissions);


    }
}
