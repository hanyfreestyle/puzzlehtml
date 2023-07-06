<?php
return [
    'menu' => [

        [
            'view'=>true,
            'sel_routs'=>'config',
            'type'=>'many',
            'text'=> 'admin.menu.setting',
            'icon'=>'fas fa-cogs',
            'submenu'=>[
                ['text'=> 'admin.menu.setting_web','url'=> 'config.web.index','sel_routs'=> 'web','icon'=>'fas fa-cog'],
                ['text'=> 'admin.menu.setting_meta_tags','url'=> 'config.meta.index','sel_routs'=> 'meta','icon'=>'fab fa-html5'],
                ['text'=> 'admin.menu.setting_def_photo','url'=> 'config.defPhoto.index','sel_routs'=> 'defPhoto','icon'=>'fas fa-image'],
                ['text'=> 'admin.menu.uploadFilter','url'=> 'config.upFilter.index','sel_routs'=> 'upFilter','icon'=>'fas fa-filter'],
                ['text'=> 'admin.deficon.main.title','url'=> 'config.defIcon.show','sel_routs'=> 'defIcon','icon'=>'fab fa-fonticons'],

            ],
        ],

        [
            'view'=>true,
            'sel_routs'=>'amenity',
            'type'=>'one',
            'text'=> 'Amenitys',
            'url'=> 'amenity.index',
            'icon'=>'fas fa-swimming-pool'
        ],




    ],

];
