<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        $user = User::findOrFail(1);

        $role = Role::where('name', 'admin')->firstOrFail();

        $role->syncPermissions($role->permissions);

    }
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (1, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (2, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (3, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (4, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (5, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (6, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (7, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (8, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (9, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (10, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (11, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (12, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (13, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (14, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (15, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (16, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (17, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (18, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (19, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (20, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (21, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (22, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (23, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (24, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (25, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (26, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (27, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (28, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (29, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (30, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (31, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (32, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (33, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (34, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (35, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (36, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (37, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (38, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (39, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (40, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (41, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (42, 1);

//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (43, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (44, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (45, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (46, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (47, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (48, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (49, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (50, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (51, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (52, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (53, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (54, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (55, 1);
//INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (56, 1);

}
