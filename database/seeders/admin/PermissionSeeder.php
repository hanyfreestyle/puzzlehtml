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
            ['name' => 'users_add','name_ar'=>'اضافة مستخدم جديد','name_en'=>'User Add'],
            ['name' => 'users_edit','name_ar'=>'تعديل على مستخدم حالى','name_en'=>'User Edit'],
            ['name' => 'users_delete','name_ar'=>'حذف مستخدم','name_en'=>'User Delete'],

            ['name' => 'roles_view','name_ar'=>'عرض  مجموعات الصلاحيات','name_en'=>'Roles View'],
            ['name' => 'roles_add','name_ar'=>'اضافة مجموعة صلاحيات','name_en'=>'Roles Add'],
            ['name' => 'roles_edit','name_ar'=>'تعديل مجموعة صلاحيات','name_en'=>'Roles Edit'],
            ['name' => 'roles_delete','name_ar'=>'حذف مجموعة صلاحيات','name_en'=>'Roles Delete'],


            ['name' => 'amenity_view','name_ar'=>'عرض الخصائص','name_en'=>'Amenity View'],
            ['name' => 'amenity_add','name_ar'=>'اضافة الخصائص','name_en'=>'Amenity Add '],
            ['name' => 'amenity_edit','name_ar'=>'تعديل الخصائص','name_en'=>'Amenity Edit'],
            ['name' => 'amenity_delete','name_ar'=>'حذف الخصائص','name_en'=>'Amenity Delete'],


        ];

        $countData =  Permission::all()->count();
        if($countData == '0'){
            foreach ($data as $value){
                Permission::create($value);
            }
        }
    }
}
