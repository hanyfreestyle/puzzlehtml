<?php
return [
    'menu' => [
        [
            'view'=>true,
            'sel_routs'=>'amenity',
            'type'=>'one',
            'text'=> 'Amenitys',
            'url'=> 'amenity.index',
            'icon'=>'fas fa-tachometer-alt'
        ],

        [
            'view'=>true,
            'sel_routs'=>'config',
            'type'=>'many',
            'text'=> 'admin.menu.setting',
            'icon'=>'fas fa-cogs',
            'submenu'=>[
                ['text'=> 'admin.menu.setting_web','url'=> 'config.web.index','sel_routs'=> 'web'],
                ['text'=> 'admin.menu.setting_meta_tags','url'=> 'config.meta.index','sel_routs'=> 'meta'],
                ['text'=> 'admin.menu.setting_def_photo','url'=> 'config.defPhoto.index','sel_routs'=> 'defPhoto'],
                ['text'=> 'admin.menu.uploadFilter','url'=> 'config.upFilter.index','sel_routs'=> 'upFilter'],
                ['text'=> 'admin.deficon.main.title','url'=> 'config.defIcon.show','sel_routs'=> 'defIcon'],

            ],
        ],


    ],

];
