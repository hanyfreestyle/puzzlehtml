<?php
return [
    'ActiveState'=>[
        "1"=> ['id'=>'0','name'=>"غير فعال"],
        "2"=> ['id'=>'1','name'=>"فعال"],
    ],

    "fontFileList" => glob("assets/admin/intervention/font/*.ttf"),
    "logoFileList" => glob('assets/admin/intervention/watermark/*.png'),

    'FilterTypeArr'=>[
        "1"=> ['id'=>'1','name'=>"لا تقوم بالتعديل اثناء الرفع"],
        "2"=> ['id'=>'2','name'=>"التصغير وفقا للعرض"],
        "3"=> ['id'=>'3','name'=>"التصغير وفقا للطول"],
        "4"=> ['id'=>'4','name'=>"قص الصورة وفقا للطول والعرض"],
        "5"=> ['id'=>'5','name'=>"ضبط ابعاد الصورة وفقا للطول والعرض مع اضافة خلفية"],
    ],

    "textPositionArr" => [
        "1"=> ['id'=>'top','name'=>"Top"],
        "2"=> ['id'=>'center','name'=>"Center"],
        "3"=> ['id'=>'bottom','name'=>"Bottom"],
    ],

    "watermarkPositionArr" => [
        "1"=> ['id'=>'top-left','name'=>"Top Left"],
        "2"=> ['id'=>'top','name'=>"Top"],
        "3"=> ['id'=>'top-right','name'=>"Top Right"],
        "4"=> ['id'=>'left','name'=>"Left"],
        "5"=> ['id'=>'center','name'=>"Center"],
        "6"=> ['id'=>'right','name'=>"Right"],
        "7"=> ['id'=>'bottom-left','name'=>"Bottom Left"],
        "8"=> ['id'=>'bottom','name'=>"Bottom"],
        "9"=> ['id'=>'bottom-right','name'=>"Bottom Right"],
    ],

];
