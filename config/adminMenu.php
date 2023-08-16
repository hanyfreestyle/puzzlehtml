<?php

 return [
    'menu' => [

        [
            'view'=>true,
            'sel_routs'=>'config',
            'type'=>'many',
            'text'=> 'admin/menu.setting',
            'icon'=>'fas fa-cogs',
            'roleView'=>'config_section',
            'submenu'=>[
                ['roleView'=>'website_config','text'=> 'admin/menu.setting_web','url'=> 'config.web.index','sel_routs'=> 'web','icon'=>'fas fa-cog'],
                ['roleView'=>'website_config','text'=> 'admin/menu.setting_model','url'=> 'config.model.index','sel_routs'=> 'model', 'icon'=>'fas fa-cog'],
                ['roleView'=>'meta_view','text'=> 'admin/menu.setting_meta_tags','url'=> 'config.meta.index','sel_routs'=> 'meta','icon'=>'fab fa-html5'],
                ['roleView'=>'defPhoto_view','text'=> 'admin/menu.setting_def_photo','url'=> 'config.defPhoto.index','sel_routs'=> 'defPhoto','icon'=>'fas fa-image'],
                ['roleView'=>'upFilter_view','text'=> 'admin/menu.uploadFilter','url'=> 'config.upFilter.index','sel_routs'=> 'upFilter','icon'=>'fas fa-filter'],
                ['roleView'=>'config_section','text'=> 'admin/menu.setting_icon','url'=> 'config.defIcon.show','sel_routs'=> 'defIcon','icon'=>'fab fa-fonticons'],
            ],
        ],

        [
            'view'=>true,
            'sel_routs'=>'amenity',
            'type'=>'one',
            'text'=> 'admin/menu.amenity',
            'url'=> 'amenity.index',
            'icon'=>'fas fa-swimming-pool',
            'roleView'=>'amenity_view',
        ],

        [
            'view'=>true,
            'sel_routs'=>'weblang',
            'type'=>'one',
            'text'=> 'admin/menu.lang_file_web',
            'url'=> 'weblang.index',
            'icon'=>'fas fa-globe-africa',
            'roleView'=>'weblang_view',
        ],

        [
            'view'=>true,
            'sel_routs'=>'adminlang',
            'type'=>'one',
            'text'=> 'admin/menu.lang_file_admin',
            'url'=> 'adminlang.index',
            'icon'=>'fas fa-globe-africa',
            'roleView'=>'adminlang_view',
        ],

        [
            'view'=>true,
            'sel_routs'=>'users',
            'type'=>'many',
            'text'=> 'admin/menu.roles',
            'icon'=>'fas fa-unlock-alt',
            'roleView'=>'users_view',
            'submenu'=>[

                ['roleView'=>'users_view','text'=> 'admin/menu.roles_users' ,'url'=> 'users.users.index', 'sel_routs'=> 'users','icon'=>'fas fa-users'],
                ['roleView'=>'roles_view','text'=> 'admin/menu.roles_role','url'=>  'users.roles.index','sel_routs'=> 'roles','icon'=>'fas fa-traffic-light'],
                ['roleView'=>'permissions_view','text'=> 'admin/menu.roles_permissions' ,'url'=> 'users.permissions.index','sel_routs'=> 'permissions','icon'=>'fas fa-user-shield'],
            ],

        ],

        [
            'view'=>true,
            'sel_routs'=>'category',
            'type'=>'one',
            'text'=> 'admin/menu.category',
            'url'=> 'category.index',
            'icon'=>'fas fa-sitemap',
            'roleView'=>'category_view',
        ],

        [
            'view'=>true,
            'sel_routs'=>'post',
            'type'=>'one',
            'text'=> 'admin/menu.post',
            'url'=> 'post.index',
            'icon'=>'fab fa-blogger',
            'roleView'=>'post_view',
        ],


        [
            'view'=>true,
            'sel_routs'=>'location',
            'type'=>'one',
            'text'=> 'admin/menu.location',
            'url'=> 'location.index',
            'icon'=>'fas fa-map-marker-alt',
            'roleView'=>'location_view',
        ],

        [
            'view'=>true,
            'sel_routs'=>'developer',
            'type'=>'one',
            'text'=> 'admin/menu.developer',
            'url'=> 'developer.index',
            'icon'=>'fas fa-truck-monster',
            'roleView'=>'developer_view',
        ],

        [
            'view'=>true,
            'sel_routs'=>'project',
            'type'=>'one',
            'text'=> 'admin/menu.project',
            'url'=> 'project.index',
            'icon'=>'fas fa-building',
            'roleView'=>'project_view',
        ],

        [
            'view'=>true,
            'sel_routs'=>'unit',
            'type'=>'one',
            'text'=> 'admin/menu.unit',
            'url'=> 'unit.index',
            'icon'=>'fas fa-bath',
            'roleView'=>'unit_view',
        ],

        [
            'view'=>true,
            'sel_routs'=>'update',
            'type'=>'one',
            'text'=> 'admin/menu.project_update',
            'url'=> 'update.UpdateListing',
            'icon'=>'fas fa-database',
            'roleView'=>'project_view',
        ],


//        [
//            'view'=>true,
//            'sel_routs'=>'cash',
//            'type'=>'one',
//            'text'=> 'Cash',
//            'url'=> 'cash.index',
//            'icon'=>'fas fa-bath',
//            'roleView'=>'unit_view',
//        ],

    ],

];
