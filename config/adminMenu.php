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
            'type'=>'one',
            'text'=> 'Page 2',
            'url'=> 'admin.page2',
            'icon'=>'fas fa-tachometer-alt'
        ],
        [
            'type'=>'many',
            'text'=> 'Settings',
            'icon'=>'fas  fa-home',
            'submenu'=>[
                ['text'=> 'Web','url'=> 'admin.config.web'],
                ['text'=> 'Photo','url'=> 'admin.config.photo'],
                ['text'=> 'Env','url'=> 'admin.config.env'],
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
