<?php

namespace Database\Seeders\admin;

use App\Models\admin\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PostSeeder extends Seeder
{

    public function run(): void
    {


        /*
        $old_Posts = DB::connection('mysql2')->table('posts')->get();
        foreach ($old_Posts as $onePost)
        {
            $data = [
                'id'=>$onePost->id ,
                'category_id'=>$onePost->category_id ,
                'developer_id'=>$onePost->developer_id ,
                'listing_id'=>$onePost->listing_id ,
                'slug'=>$onePost->slug ,
                'slider_images_dir'=>$onePost->slider_images_dir ,

                'is_published'=>$onePost->is_published ,
                'published_at'=>$onePost->published_at ,
                'created_at'=>$onePost->created_at ,
                'deleted_at'=>$onePost->deleted_at ,
                'updated_at'=>$onePost->updated_at  ,
            ];
            Post::create($data);
        }



        $Post_List = Post::all();
        foreach ($Post_List as $Post_is){
            $old_Post = DB::connection('mysql2')->table('images')
                ->where('imageable_type','=',"App\Post")
                ->where('imageable_id',"=",$Post_is->id)
                ->get();

            if(count($old_Post) == '1'){
                $Update = Post::findOrFail($Post_is->id);
                $Update->photo = $old_Post->first()->image_url;
                $Update->photo_thum_1 = $old_Post->first()->thumb_url;
                $Update->save();
            }
        }
*/


//        $old_Posts = DB::connection('mysql2')->table('backup_posts')->get();
//        foreach ($old_Posts as $onePost)
//        {
//            $data = [
//                'id'=>$onePost->id ,
//                'category_id'=>$onePost->category_id ,
//                'developer_id'=>$onePost->developer_id ,
//                'listing_id'=>$onePost->listing_id ,
//                'slug'=>$onePost->slug ,
//                'photo'=>$onePost->photo ,
//                'photo_thum_1'=>$onePost->photo_thum_1 ,
//                'slider_images_dir'=>$onePost->slider_images_dir ,
//
//                'is_published'=>$onePost->is_published ,
//                'published_at'=>$onePost->published_at ,
//                'created_at'=>$onePost->created_at ,
//                'deleted_at'=>$onePost->deleted_at ,
//                'updated_at'=>$onePost->updated_at  ,
//            ];
//            Post::create($data);
//        }

        Post::unguard();
        $tablePath = public_path('db/posts.sql');
        DB::unprepared(file_get_contents($tablePath));


    }
}
