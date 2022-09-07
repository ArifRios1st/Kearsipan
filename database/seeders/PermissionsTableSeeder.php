<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'title' => 'user_management_access',
            ],
            [
                'title' => 'permission_create',
            ],
            [
                'title' => 'permission_edit',
            ],
            [
                'title' => 'permission_show',
            ],
            [
                'title' => 'permission_delete',
            ],
            [
                'title' => 'permission_access',
            ],
            [
                'title' => 'role_create',
            ],
            [
                'title' => 'role_edit',
            ],
            [
                'title' => 'role_show',
            ],
            [
                'title' => 'role_delete',
            ],
            [
                'title' => 'role_access',
            ],
            [
                'title' => 'user_create',
            ],
            [
                'title' => 'user_edit',
            ],
            [
                'title' => 'user_show',
            ],
            [
                'title' => 'user_delete',
            ],
            [
                'title' => 'user_access',
            ],
            [
                'title' => 'profile_password_edit',
            ],
            [
                'title' => 'servicer_create',
            ],
            [
                'title' => 'servicer_edit',
            ],
            [
                'title' => 'servicer_show',
            ],
            [
                'title' => 'servicer_delete',
            ],
            [
                'title' => 'servicer_access',
            ],
            [
                'title' => 'letter_in_create',
            ],
            [
                'title' => 'letter_in_edit',
            ],
            [
                'title' => 'letter_in_show',
            ],
            [
                'title' => 'letter_in_delete',
            ],
            [
                'title' => 'letter_in_access',
            ],
            [
                'title' => 'letter_out_create',
            ],
            [
                'title' => 'letter_out_edit',
            ],
            [
                'title' => 'letter_out_show',
            ],
            [
                'title' => 'letter_out_delete',
            ],
            [
                'title' => 'letter_out_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
