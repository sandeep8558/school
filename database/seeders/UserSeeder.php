<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Branch;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branch = Branch::first();
        $branchId = $branch ? $branch->id : 1;

        $users = [
            [
                'name'              => 'Sandeep Rathod',
                'email'             => 'sandeep198558@gmail.com',
                'mobile'            => '9664588677',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'branch_id'         => $branchId,
                'roles'             => ['Administrator', 'Student'],
            ],
            [
                'name'              => 'Leena Adam',
                'email'             => 'leenaadam28@gmail.com',
                'mobile'            => '9769409405',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'branch_id'         => $branchId,
                'roles'             => ['Administrator', 'Student'],
            ],
        ];

        foreach ($users as $userData) {
            $roles = $userData['roles'];
            unset($userData['roles']);

            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );

            foreach ($roles as $role) {
                UserRole::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'role'    => $role,
                    ],
                    [
                        'user_id' => $user->id,
                        'role'    => $role,
                    ]
                );
            }
        }
    }
}
