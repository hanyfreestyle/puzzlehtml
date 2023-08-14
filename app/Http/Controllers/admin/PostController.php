<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Helpers\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\DeveloperRequest;
use App\Http\Requests\admin\PostRequest;
use App\Models\admin\Category;
use App\Models\admin\Developer;
use App\Models\admin\DeveloperPhoto;
use App\Models\admin\DeveloperTranslation;
use App\Models\admin\Location;
use App\Models\admin\Post;
use App\Models\admin\PostPhoto;
use App\Models\admin\PostTranslation;
use File;
use Illuminate\Http\Request;
use DB ;

class PostController extends AdminMainController
{
    public $controllerName ;

    function __construct($controllerName = 'post')
    {
        parent::__construct();
        $this->controllerName = $controllerName;
        $this->middleware('permission:'.$controllerName.'_view', ['only' => ['index']]);
        $this->middleware('permission:'.$controllerName.'_add', ['only' => ['create']]);
        $this->middleware('permission:'.$controllerName.'_edit', ['only' => ['edit']]);
        $this->middleware('permission:'.$controllerName.'_delete', ['only' => ['destroy']]);
        $this->middleware('permission:'.$controllerName.'_restore', ['only' => ['SoftDeletes','Restore','ForceDeletes']]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index()
    {
        $sendArr = ['TitlePage' => __('admin/menu.post'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Post::onlyTrashed()->count();

        $Posts = self::getSelectQuery( Post::where('id',"!=","0")->with('getMorePhoto'));

        return view('admin.post.post_index',compact('pageData','Posts'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes()
    {
        $sendArr = ['TitlePage' => __('admin/menu.post') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "deleteList";
        $Posts = self::getSelectQuery(Post::onlyTrashed());

        return view('admin.post.post_index',compact('pageData','Posts'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create()
    {
        $sendArr = ['TitlePage' => __('admin/menu.developer') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Add";

        $Post = Post::findOrNew(0);
        $Developers = Developer::all();
        $Categories = Category::all();
        $Locations = Location::all();
        return view('admin.post.post_form',compact('pageData','Post','Developers','Categories','Locations'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.developer') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $Post = Post::findOrFail($id);
        $Developers = Developer::all();
        $Categories = Category::all();
        $Locations = Location::all();
        return view('admin.post.post_form',compact('pageData','Post','Developers','Categories','Locations'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(PostRequest $request, $id=0)
    {


        $saveData =  Post::findOrNew($id);
        $saveData->slug = AdminHelper::Url_Slug($request->slug);
        $saveData->category_id = $request->input('category_id');
        $saveData->developer_id = $request->input('developer_id');
        $saveData->location_id = $request->input('location_id');
        $saveData->setPublished((bool) request('is_published', false));
        $saveData->save();

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('post/'.$saveData->id);
        $saveImgData->setnewFileName($request->input('slug'));
        $saveImgData->UploadOne($request);
        $saveData = AdminHelper::saveAndDeletePhoto($saveData,$saveImgData);
        $saveData->save();


        foreach ( config('app.lang_file') as $key=>$lang) {
            $saveTranslation = PostTranslation::where('post_id',$saveData->id)->where('locale',$key)->firstOrNew();
            $saveTranslation->post_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->name = $request->input($key.'.name');
            $saveTranslation->des = $request->input($key.'.des');
            $saveTranslation->g_title = $request->input($key.'.g_title');
            $saveTranslation->g_des = $request->input($key.'.g_des');
            $saveTranslation->body_h1 = $request->input($key.'.body_h1');
            $saveTranslation->breadcrumb = $request->input($key.'.breadcrumb');
            $saveTranslation->save();
        }


        if($saveData->slug_count > 1){
            $updateSlugCount = Post::withTrashed()
                ->where('slug_count' ,'>',"1")
                ->get();
            ;
            if( count($updateSlugCount) > 0 ){
                foreach ($updateSlugCount as $listing){
                    $newCount = Post::withTrashed()->where('slug', $listing->slug )->count();
                    $listing->slug_count = $newCount;
                    $listing->save();
                }
            }
        }



        //dd($saveData->slug);
        if($id == '0'){
            return redirect(route('post.index'))->with('Add.Done',"");
        }else{
            return back();
            ////return redirect(route('post.index'))->with('Edit.Done',"");
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id)
    {
        $deleteRow = Post::findOrFail($id);
        $deleteRow->delete();
        return redirect(route('post.index'))->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Restore
    public function Restore($id)
    {
        Post::onlyTrashed()->where('id',$id)->restore();
        return back()->with('restore',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function ForceDeletes($id)
    {

        $delMorePhoto = PostPhoto::where('post_id',"=",$id)->get();
        if(count($delMorePhoto) > 0){
            foreach ($delMorePhoto as $del_photo ){
                $del_photo = AdminHelper::DeleteAllPhotos($del_photo);
            }
        }

        $deleteRow =  Post::onlyTrashed()->where('id',$id)->first();
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->forceDelete();

        return back()->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     EmptyPhoto
    public function emptyPhoto($id){
        $rowData = Post::findOrFail($id);
        $rowData = AdminHelper::DeleteAllPhotos($rowData,true);
        $rowData->save();
        return back();
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function ListMorePhoto($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.post') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $PostPhotos = PostPhoto::where('post_id','=',$id)->orderBy('position')->with('postName')->get();
        $Post = Post::findOrFail($id) ;

        return view('admin.post.post_photos',compact('PostPhotos','pageData','Post'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     sortDefPhotoList
    public function sortPhotoSave(Request $request){
        $positions = $request->positions;
        foreach($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData =  PostPhoto::findOrFail($id) ;
            $saveData->position = $newPosition;
            $saveData->save();
        }
        return response()->json(['success'=>$positions]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     AddMorePhotos
    public function AddMorePhotos(Request $request)
    {

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('post/'.$request->post_id);
        $saveImgData->setnewFileName($request->input('name'));
        $saveImgData->UploadMultiple($request);

        foreach ($saveImgData->sendSaveData as $newPhoto){
            $saveData =  PostPhoto::findOrNew('0');
            $saveData->post_id   =  $request->post_id;
            $saveData->photo = $newPhoto['photo']['file_name'];
            $saveData->photo_thum_1 = $newPhoto['photo_thum_1']['file_name'];
            $saveData->save();
        }

        return back()->with('Add.Done',"");

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     More_PhotosDestroy
    public function More_PhotosDestroy($id){
        $deleteRow = PostPhoto::findOrFail($id);
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->delete();
        return back()->with('confirmDelete',"");
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     noPhoto
    public function noPhoto()
    {

        $sendArr = ['TitlePage' => __('admin/menu.post'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Post::onlyTrashed()->count();

        $Posts = self::getSelectQuery( Post::where('id',"!=","0")->where('photo',null)->with('getMorePhoto'));

        return view('admin.post.post_index',compact('pageData','Posts'));



    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     slugErr
    public function slugErr()
    {

        $sendArr = ['TitlePage' => __('admin/menu.post'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Post::onlyTrashed()->count();

        $Posts = self::getSelectQuery( Post::where('id',"!=","0")->where('slug_count','>',1)->with('getMorePhoto'));

        return view('admin.post.post_index',compact('pageData','Posts'));


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     noEn
    public function noEn()
    {
        $sendArr = ['TitlePage' => __('admin/menu.post'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Post::onlyTrashed()->count();
        $Posts= Post::whereHas('teans_en', function ($query) {
            $query->where('des', '=', null);

        })->paginate(10);
        return view('admin.post.post_index',compact('pageData','Posts'));

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     noAr
    public function noAr()
    {


        $sendArr = ['TitlePage' => __('admin/menu.post'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Post::onlyTrashed()->count();
        $Posts= Post::whereHas('teans_ar', function ($query) {
            $query->where('des', '=', null);

        })->paginate(10);
        return view('admin.post.post_index',compact('pageData','Posts'));

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     unActive
    public function unActive()
    {


        $sendArr = ['TitlePage' => __('admin/menu.post'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Post::onlyTrashed()->count();

        $Posts = self::getSelectQuery( Post::where('id',"!=","0")->where('is_published',false)->with('getMorePhoto'));

        return view('admin.post.post_index',compact('pageData','Posts'));



    }




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     sliderGet
    public function sliderGet()
    {

        $Posts = Post::where('slider_images_dir','!=',null)
            ->where('slider_get',"=","0")
            ->where('id','!=',"0")
            ->paginate(10000);

        $foreign_name = "post_id";
        $save_table_name = "post_photos";


        foreach ($Posts as $post){

            $oldPath = public_path("ckfinder/userfiles_old/".$post->slider_images_dir);
            $newPath =  public_path("ckfinder/userfiles/".$post->slider_images_dir) ;

            if(File::exists($oldPath)){
                Update_createDirectory($newPath);

                if(File::exists($newPath)){
                    $files = File::files($oldPath);
                    if( count( $files) >0 ) {
                        foreach ($files as $file){
                            $filename = File::name($file).".".File::extension($file);
                            $OldFileWillCopyFrom = $oldPath."/".$filename;
                            $newFileWillCopy = $newPath."/".$filename;

                            if(!File::exists($newFileWillCopy)){

                                File::copy($OldFileWillCopyFrom,$newFileWillCopy);
                                DB::connection('mysql2')->table($save_table_name)->insert([
                                    $foreign_name => $post->id,
                                    'photo' => "ckfinder/userfiles/".$post->slider_images_dir."/".$filename ,
                                    'file_extension' =>  File::extension($file),
                                    'file_size' => File::size($file),

                                ]);

                                $post->slider_get = 1 ;
                                $post->save();

                                echobr("save");
                            }
                        }
                    }
                }
            }else{
                $post->slider_get = 2 ;
                $post->save();
                echobr("Error");
            }
        }



        dd(count($Posts));

    }










































    public function RemovePhoto()
    {

        $allData = Post::withTrashed()->get();

        foreach ($allData as $data){
            if($data->photo != null){

                $oldfile = public_path($data->photo);
                if(File::exists($oldfile)){
                    $newFile = public_path(str_replace('posts/', 'newposts/', $data->photo));
                    echo $oldfile;
                    echo "<br>";
                    echo $newFile;
                    echo "<br>";
                    echo '<hr>';
                    File::move($oldfile, $newFile);
                }


                $oldfile = public_path($data->photo_thum_1);
                if(File::exists($oldfile)){
                    $newFile = public_path(str_replace('posts/', 'newposts/', $data->photo_thum_1));
                    echo $oldfile;
                    echo "<br>";
                    echo $newFile;
                    echo "<br>";
                    echo '<hr>';
                    File::move($oldfile, $newFile);
                }


            }
        }




    }



}
