<?php

namespace Database\Seeders\config;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
                'password' => Hash::make('12345678'),
                'roles_name' => ['editor'],

            ],
            [
                'name' => 'Editor',
                'email' => 'editor@test.com',
                'password' => Hash::make('12345678'),
                'roles_name' => ['editor'],
            ],
        ];
        $userCount = User::all()->count();
        if($userCount == '1'){
            foreach ($users as $key => $value){
                $user = User::create($value);
               // $permissions = Permission::pluck('id','id')->all();
                $role = Role::findByName('editor');
                //$role->syncPermissions($permissions);
                $user->assignRole([$role->id]);
            }
        }
    }
}
