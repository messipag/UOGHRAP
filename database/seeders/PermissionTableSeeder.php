<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            
            'dashboard',

            'user-list',
            'user-show',
            'user-create',
            'user-edit',
            'user-delete',

            'role-list',
            'role-show',
            'role-create',
            'role-edit',
            'role-delete',
            
            'permission-list',
            'permission-show',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'category-list',
            'category-show',
            'category-create',
            'category-edit',
            'category-delete', 
        ];

        foreach ($data as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}