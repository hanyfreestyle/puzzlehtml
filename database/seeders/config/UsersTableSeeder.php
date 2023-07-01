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
            'name' => 'Hany Darwish ',
            'email' => 'test@test.com',
            'password' => Hash::make('01221563252'),
        ];

        $userCount = User::all()->count();
        if($userCount == 0){
            User::create($users);
        }
    }
}