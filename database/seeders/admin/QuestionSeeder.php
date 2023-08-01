<?php

namespace Database\Seeders\admin;

use App\Models\admin\PostPhoto;
use App\Models\admin\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class QuestionSeeder extends Seeder
{

    public function run(): void
    {


//        $old_Questions = DB::connection('mysql2')->table('questions')
//            ->where('project_id', '!=',3)
//            ->where('project_id', '!=', 27207)
//            ->get();
//        foreach ($old_Questions as $oneQuestions)
//        {
//            $data = [
//                'id'=>$oneQuestions->id ,
//                'project_id'=>$oneQuestions->project_id ,
//                'created_at'=>$oneQuestions->created_at ,
//                'deleted_at'=>$oneQuestions->deleted_at ,
//                'updated_at'=>$oneQuestions->updated_at  ,
//            ];
//
//            Question::create($data);
//        }

        Question::unguard();
        $tablePath = public_path('db/questions.sql');
        DB::unprepared(file_get_contents($tablePath));


    }
}
