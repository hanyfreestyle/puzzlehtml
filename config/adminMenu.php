<?php
return [
    'menu' => [

        [
            'view'=>true,
            'sel_routs'=>'config',
            'type'=>'many',
            'text'=> 'admin/menu.setting',
            'icon'=>'fas fa-cogs',
            'submenu'=>[
                ['text'=> 'admin/menu.setting_web','url'=> 'config.web.index','sel_routs'=> 'web','icon'=>'fas fa-cog'],
                ['text'=> 'admin/menu.setting_meta_tags','url'=> 'config.meta.index','sel_routs'=> 'meta','icon'=>'fab fa-html5'],
                ['text'=> 'admin/menu.setting_def_photo','url'=> 'config.defPhoto.index','sel_routs'=> 'defPhoto','icon'=>'fas fa-image'],
                ['text'=> 'admin/menu.uploadFilter','url'=> 'config.upFilter.index','sel_routs'=> 'upFilter','icon'=>'fas fa-filter'],
                ['text'=> 'admin/menu.setting_icon','url'=> 'config.defIcon.show','sel_routs'=> 'defIcon','icon'=>'fab fa-fonticons'],
            ],
        ],

        [
            'view'=>true,
            'sel_routs'=>'amenity',
            'type'=>'one',
            'text'=> 'admin/menu.amenity',
            'url'=> 'amenity.index',
            'icon'=>'fas fa-swimming-pool'
        ],

        [
            'view'=>true,
            'sel_routs'=>'adminlang',
            'type'=>'one',
            'text'=> 'admin/menu.lang_file_admin',
            'url'=> 'adminlang.index',
            'icon'=>'fas fa-globe-africa'
        ],

        [
            'view'=>true,
            'sel_routs'=>'users',
            'type'=>'many',
            'text'=> 'admin/menu.roles',
            'icon'=>'fas fa-unlock-alt',
            'submenu'=>[
/*
                ['text'=> 'Users','url'=> 'users.users.index','sel_routs'=> 'users','icon'=>'fab fa-html5'],
                ['text'=> 'Roles','url'=> 'users.roles.index','sel_routs'=> 'roles','icon'=>'fab fa-html5'],
                ['text'=> 'Permissions','url'=> 'users.permissions.index','sel_routs'=> 'permissions','icon'=>'fas fa-cog'],

__()
*/
                ['text'=> 'admin/menu.roles_users' ,'url'=> 'adminlang.index','sel_routs'=> 'users','icon'=>'fas fa-users'],
                ['text'=> 'admin/menu.roles_role','url'=> 'adminlang.index','sel_routs'=> 'roles','icon'=>'fas fa-traffic-light'],
                ['text'=> 'admin/menu.roles_permissions' ,'url'=> 'adminlang.index','sel_routs'=> 'permissions','icon'=>'fas fa-user-shield'],
            ],

        ],

    ],

];
