<?php

namespace Database\Seeders\roles;

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

            ['cat_id'=> '5', 'name' => 'adminlang_view','name_ar'=>'عرض ملفات لغة التحكم','name_en'=>'View Admin Lang'],
            ['cat_id'=> '5', 'name' => 'adminlang_edit','name_ar'=>'تعديل ملفات لغة التحكم','name_en'=>'Edit Admin Lang'],
            ['cat_id'=> '5', 'name' => 'weblang_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '5', 'name' => 'weblang_edit','name_ar'=>'تعديل','name_en'=>'Edit'],

            ['cat_id'=> '6', 'name' => 'config_section','name_ar'=>'عرض الاعدادات','name_en'=>'Setting View'],
            ['cat_id'=> '6', 'name' => 'website_config','name_ar'=>'اعدادات الموقع','name_en'=>'Web Site Setting'],

            ['cat_id'=> '7', 'name' => 'meta_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '7', 'name' => 'meta_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '7', 'name' => 'meta_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '7', 'name' => 'meta_delete','name_ar'=>'حذف','name_en'=>'Delete'],

            ['cat_id'=> '8', 'name' => 'defPhoto_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '8', 'name' => 'defPhoto_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '8', 'name' => 'defPhoto_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '8', 'name' => 'defPhoto_delete','name_ar'=>'حذف','name_en'=>'Delete'],

            ['cat_id'=> '9', 'name' => 'upFilter_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '9', 'name' => 'upFilter_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '9', 'name' => 'upFilter_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '9', 'name' => 'upFilter_delete','name_ar'=>'حذف','name_en'=>'Delete'],

            ['cat_id'=> '10', 'name' => 'category_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '10', 'name' => 'category_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '10', 'name' => 'category_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '10', 'name' => 'category_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '10', 'name' => 'category_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],

            ['cat_id'=> '11', 'name' => 'post_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '11', 'name' => 'post_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '11', 'name' => 'post_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '11', 'name' => 'post_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '11', 'name' => 'post_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],

            ['cat_id'=> '12', 'name' => 'location_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '12', 'name' => 'location_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '12', 'name' => 'location_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '12', 'name' => 'location_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '12', 'name' => 'location_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],

            ['cat_id'=> '13', 'name' => 'developer_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '13', 'name' => 'developer_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '13', 'name' => 'developer_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '13', 'name' => 'developer_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '13', 'name' => 'developer_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],

            ['cat_id'=> '14', 'name' => 'project_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '14', 'name' => 'project_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '14', 'name' => 'project_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '14', 'name' => 'project_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '14', 'name' => 'project_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],

            ['cat_id'=> '15', 'name' => 'unit_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '15', 'name' => 'unit_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '15', 'name' => 'unit_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '15', 'name' => 'unit_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '15', 'name' => 'unit_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],


        ];

        $countData =  Permission::all()->count();
        if($countData == '0'){
            foreach ($data as $value){
                Permission::create($value);
            }
        }
    }
}
