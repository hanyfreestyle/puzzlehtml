<?php

namespace Database\Seeders\admin;


use App\Models\admin\PostPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class PostPhotoSeeder extends Seeder
{

    public function run(): void
    {


//        $old_Posts = DB::connection('mysql2')->table('post_photos')->get();
//        foreach ($old_Posts as $onePost)
//        {
//            $data = [
//                'id'=>$onePost->id ,
//                'post_id'=>$onePost->post_id ,
//                'photo'=>$onePost->photo ,
//                'file_extension'=>$onePost->file_extension ,
//                'file_size'=>$onePost->file_size ,
//
//                'created_at'=>$onePost->created_at ,
//                'deleted_at'=>$onePost->deleted_at ,
//                'updated_at'=>$onePost->updated_at  ,
//            ];
//            PostPhoto::create($data);
//        }
//

        PostPhoto::unguard();
        $tablePath = public_path('db/post_photos.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
