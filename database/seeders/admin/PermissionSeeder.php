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
            ['cat_id'=> '1', 'name' => 'users_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '1', 'name' => 'users_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '1', 'name' => 'users_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '1', 'name' => 'users_delete','name_ar'=>'حذف','name_en'=>'Delete'],

            ['cat_id'=> '2', 'name' => 'roles_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '2', 'name' => 'roles_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '2', 'name' => 'roles_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '2', 'name' => 'roles_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '2', 'name' => 'roles_update_permissions','name_ar'=>'تعديل صلاحيات المجموعة','name_en'=>'Roles Update Permissions'],

            ['cat_id'=> '3', 'name' => 'permissions_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '3', 'name' => 'permissions_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '3', 'name' => 'permissions_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '3', 'name' => 'permissions_delete','name_ar'=>'حذف','name_en'=>'Delete'],

            ['cat_id'=> '4', 'name' => 'amenity_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '4', 'name' => 'amenity_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '4', 'name' => 'amenity_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '4', 'name' => 'amenity_delete','name_ar'=>'حذف','name_en'=>'Delete'],


        ];

        $countData =  Permission::all()->count();
        if($countData == '0'){
            foreach ($data as $value){
                Permission::create($value);
            }
        }
    }
}
