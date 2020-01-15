<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'valentin@hitech.com.mk',
                'password'           => '$2y$10$4ZbMxcqIrFVjzsvLDVH4puBhlhjX2AYo.ASkWV0R.39GGnvsR/eTW',
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2019-12-18 12:33:19',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}
