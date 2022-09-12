<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2022-09-06 19:04:08',
                'verification_token' => '',
            ],
            [
                'id'                 => 2,
                'name'               => 'User',
                'email'              => 'user@user.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2022-09-06 19:04:08',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}
