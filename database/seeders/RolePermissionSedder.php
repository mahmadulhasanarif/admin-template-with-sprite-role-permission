<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        // Do same for the admin guard for tutorial purposes
        $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);
        $Admin = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $writer = Role::create(['name' => 'writer', 'guard_name' => 'admin']);

        // // Create Roles and Permissions
        // $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        // $roleAdmin = Role::create(['name' => 'admin']);
        // $roleEditor = Role::create(['name' => 'editor']);
        // $roleUser = Role::create(['name' => 'user']);
        
        
        
        
        $permissions = [

        [
            'group_name' => 'dashboard',
            'permissions' => [
                'admin.dashbaord',
            ]
        ],
        [
            'group_name' => 'profile',
            'permissions' => [
                // Blog Permissions
                'admin.profile.edit',
                'admin.profile.destroy',
                'admin.profile.status',
            ]
        ],
        [
            'group_name' => 'admin',
            'permissions' => [
                // admin Permissions
                'admin.user.index',
                'admin.user.create',
                'admin.user.edit',
                'admin.user.delete',
                'admin.user.status',
            ]
        ],
        [
            'group_name' => 'role',
            'permissions' => [
                // role Permissions
                'admin.role.index',
                'admin.role.create',
                'admin.role.edit',
                'admin.role.delete',
            ]
        ],
        [
            'group_name' => 'Permissions',
            'permissions' => [
                //  Permissions
                'admin.role_has_permission.index',
                'admin.role_has_permission.create',
                'admin.role_has_permission.edit',
                'admin.role_has_permission.delete',
            ]
        ],

        
    ];


    // Create and Assign Permissions
    // for ($i = 0; $i < count($permissions); $i++) {
    //     $permissionGroup = $permissions[$i]['group_name'];
    //     for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
    //         // Create Permission
    //         $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
    //         $roleSuperAdmin->givePermissionTo($permission);
    //         $permission->assignRole($roleSuperAdmin);
    //     }
    // }



    // Create and Assign Permissions
    for ($i = 0; $i < count($permissions); $i++) {
        $permissionGroup = $permissions[$i]['group_name'];
        for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
            // Create Permission
            $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup, 'guard_name' => 'admin']);
            $roleSuperAdmin->givePermissionTo($permission);
            $permission->assignRole($roleSuperAdmin);
        }
    }

    // Assign super admin role permission to superadmin user
    $admin = Admin::where('name', 'superadmin')->first();
    if ($admin) {
        $admin->assignRole($roleSuperAdmin);
    }
}
}
