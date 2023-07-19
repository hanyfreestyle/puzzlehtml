<?php

namespace Database\Seeders\roles;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{

    public function run(): void
    {

        $user = User::create([
            'name' => 'Hany Darwish ',
            'email' => 'test@test.com',
            'password' => Hash::make('01221563252'),
            'roles_name' => ['admin'],
        ]);

        $role = Role::create(['name' => 'admin','name_ar'=>'ادمن كامل الصلاحيات','name_en'=>'Full Admin Permission ']);

        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

    }
}
