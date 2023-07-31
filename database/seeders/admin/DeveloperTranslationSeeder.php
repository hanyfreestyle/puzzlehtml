<?php

namespace Database\Seeders\admin;


use App\Models\admin\DeveloperTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class DeveloperTranslationSeeder extends Seeder
{

    public function run(): void
    {
        $old_DeveloperTranslations = DB::connection('mysql2')->table('developer_translations')->get();
        foreach ($old_DeveloperTranslations as $old_Developer)
        {
            $data = [
                'developer_id'=> $old_Developer->developer_id ,
                'locale'=> $old_Developer->locale ,
                'name'=> $old_Developer->name  ,
                'des'=> $old_Developer->description ,
                'g_des'=> $old_Developer->meta_description ,
            ];
            DeveloperTranslation::create($data);
        }


        $saveTranslation = DeveloperTranslation::where('developer_id',11)->where('locale','ar')->firstOrNew();
        $saveTranslation->developer_id = 11;
        $saveTranslation->locale = 'ar';
        $saveTranslation->name = "ar11";
        $saveTranslation->save();

        $saveTranslation = DeveloperTranslation::where('developer_id',11)->where('locale','en')->firstOrNew();
        $saveTranslation->developer_id = 11;
        $saveTranslation->locale = 'en';
        $saveTranslation->name = "en11";
        $saveTranslation->save();


        $saveTranslation = DeveloperTranslation::where('developer_id',10)->where('locale','ar')->firstOrNew();
        $saveTranslation->developer_id = 10;
        $saveTranslation->locale = 'ar';
        $saveTranslation->name = "ar10";
        $saveTranslation->save();

        $saveTranslation = DeveloperTranslation::where('developer_id',10)->where('locale','en')->firstOrNew();
        $saveTranslation->developer_id = 10;
        $saveTranslation->locale = 'en';
        $saveTranslation->name = "en10";
        $saveTranslation->save();



        $data = [
            'developer_id'=> 331 ,
            'locale'=> 'ar' ,
            'name'=> "غير محدد"  ,
            'des'=> "غير محدد" ,
            'g_des'=> "غير محدد" ,
        ];
        DeveloperTranslation::create($data);


        $data = [
            'developer_id'=> 331 ,
            'locale'=> 'en' ,
            'name'=> "unknown"  ,
            'des'=> "unknown"  ,
            'g_des'=> "unknown"  ,
        ];
        DeveloperTranslation::create($data);


    }



}
