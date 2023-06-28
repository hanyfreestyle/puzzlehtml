<?php
return [
    'menu' => [
        [
            'type'=>'one',
            'text'=> 'Page 1',
            'url'=> 'admin.page1',
            'icon'=>'fas fa-home'
        ],
        [
            'view'=>true,
            'type'=>'one',
            'text'=> 'Amenitys',
            'url'=> 'amenity.index',
            'icon'=>'fas fa-tachometer-alt'
        ],
        [
            'view'=>false,
            'type'=>'many',
            'text'=> 'admin.menu.setting',
            'icon'=>'fas fa-cogs',
            'submenu'=>[
                ['text'=> 'admin.menu.setting_web','url'=> 'admin.config.web'],
                ['text'=> 'admin.menu.setting_meta_tags','url'=> 'Meta.index'],
               # ['text'=> 'admin.menu.setting_photo','url'=> 'admin.config.photoSize'],
               # ['text'=> 'admin.menu.setting_def_photo','url'=> 'admin.config.defPhoto'],
            ],
        ],
        [
            'type'=>'many',
            'text'=> 'Settings 2',
            'icon'=>'fas fa-tachometer-alt',
            'submenu'=>[
                ['text'=> 'Web','url'=> 'admin.config.web2'],
                ['text'=> 'Photo','url'=> 'admin.config.photo2'],
                ['text'=> 'Env','url'=> 'admin.config.env2'],
            ],
        ],


    ],
];
