<?php

namespace Database\Seeders\config;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Sub Admin  ',
                'email' => 'subadmin@test.com',
                'password' => Hash::make('01221563252'),

            ],
            [
                'name' => 'User',
                'email' => 'user@test.com',
                'password' => Hash::make('01221563252'),
                'roles_name' => "['editor']",
            ],
        ];
        $userCount = User::all()->count();
        if($userCount == '1'){
            foreach ($users as $key => $value){
                User::create($value);
            }
        }
    }
}
