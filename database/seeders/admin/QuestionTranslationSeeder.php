<?php

namespace Database\Seeders\admin;

use App\Models\admin\PostTranslation;
use App\Models\admin\QuestionTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB ;

class QuestionTranslationSeeder extends Seeder
{

    public function run(): void
    {

//
//        $old_QuestionTranslations = DB::connection('mysql2')->table('question_translations')
//            ->where('question_id', '!=', 29)
//            ->where('question_id', '!=', 1057)
//            ->where('question_id', '!=', 1058)
//            ->where('question_id', '!=', 1059)
//            ->where('question_id', '!=', 1060)
//            ->where('question_id', '!=', 1061)
//            ->where('question_id', '!=', 1062)
//            ->where('question_id', '!=', 1063)
//            ->where('question_id', '!=', 1064)
//            ->get();
//        foreach ($old_QuestionTranslations as $old_Question )
//        {
//            $data = [
//                'question_id'=> $old_Question->question_id ,
//                'locale'=> $old_Question->locale ,
//                'question'=> $old_Question->question  ,
//                'answer'=> $old_Question->answer ,
//
//            ];
//            QuestionTranslation::create($data);
//        }


        QuestionTranslation::unguard();
        $tablePath = public_path('db/question_translations.sql');
        DB::unprepared(file_get_contents($tablePath));




    }
}
