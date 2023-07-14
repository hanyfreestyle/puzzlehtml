<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            ['name' => 'users_view','name_ar'=>'عرض المستخدمين','name_en'=>'User View'],
            ['name' => 'users_add','name_ar'=>'اضافة مستخدم جديد','name_en'=>'User Add New'],
            ['name' => 'users_edit','name_ar'=>'تعديل على مستخدم حالى','name_en'=>'User Edit'],
            ['name' => 'users_delete','name_ar'=>'حذف مستخدم','name_en'=>'User Delete'],
        ];

        $countData =  Permission::all()->count();
        if($countData == '0'){
            foreach ($data as $value){
                Permission::create($value);
            }
        }
    }
}
