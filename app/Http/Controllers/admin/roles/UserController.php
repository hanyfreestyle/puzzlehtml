<?php

namespace App\Http\Controllers\admin\roles;

use App\Helpers\AdminHelper;
use App\Helpers\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\roles\UserRequest;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends AdminMainController
{
    public $controllerName ;

    function __construct($controllerName = 'users')
    {
        parent::__construct();
        $this->controllerName = $controllerName;
        $this->middleware('permission:'.$controllerName.'_view', ['only' => ['index']]);
        $this->middleware('permission:'.$controllerName.'_add', ['only' => ['create']]);
        $this->middleware('permission:'.$controllerName.'_edit', ['only' => ['edit','updateStatus','emptyPhoto']]);
        $this->middleware('permission:'.$controllerName.'_delete', ['only' => ['destroy']]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index()
    {
        $sendArr = ['TitlePage' => __('admin/config/roles.users_title') ,'ListPage'=>__('admin/config/roles.users_list'),'selMenu'=> 'users.'];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";

        $users = User::orderBy('id')->paginate(10);
        $roles = Role::all();
        return view('admin.role.user_index',compact('pageData','users','roles'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create()
    {
        $sendArr = ['TitlePage' => __('admin/config/roles.users_title'),'selMenu'=> 'users.'];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Add";

        $users = User::findOrNew(0);
        $roles = Role::all();
        return view('admin.role.user_form',compact('pageData','users','roles'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id)
    {
        $sendArr = ['TitlePage' => __('admin/config/roles.users_title') ,'selMenu'=> 'users.' ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $users = User::findOrFail($id);
        $roles = Role::all();
        $userRole = $users->roles->pluck('name','id')->all();
        return view('admin.role.user_form',compact('users','pageData','roles','userRole'));

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(UserRequest $request, $id=0)
    {


        $request-> validated();

        $saveData =  User::findOrNew($id);
        $saveData->name = $request->name;
        $saveData->email = $request->email;
        $saveData->phone = $request->phone;

        if(trim($request->user_password != '')){
            $saveData->password = Hash::make($request->user_password);
        }

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setUploadDirIs('user-profile')->setnewFileName($request->input('name'));

        $saveImgData->UploadOneNofilter($request,'4',300,300);
        $saveData = AdminHelper::saveAndDeletePhotoByOne($saveData,$saveImgData,'photo');

        $saveImgData->UploadOneNofilter($request,'4',100,100);
        $saveData = AdminHelper::saveAndDeletePhotoByOne($saveData,$saveImgData,'photo_thum_1');


        $saveData->roles_name = $request->input('roles');
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $saveData->assignRole($request->input('roles'));


        $saveData->save();

        if($id == '0'){
            return redirect(route('users.users.index'))->with('Add.Done',"");
        }else{
            return redirect(route('users.users.index'))->with('Edit.Done',"");
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id)
    {
        if($id != '1'){
            $deleteRow = User::findOrFail($id);
            $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
            $deleteRow->delete();
            return redirect(route('users.users.index'))->with('confirmDelete',"");
        }else{
            return back();
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  updateStatus
    public function updateStatus(Request $request ){
        $userId  = $request->send_id;
        if($userId != '1'){
            $updateData = User::findOrFail($userId);
            if($updateData->status == '1'){
                $updateData->status = '0';
            }else{
                $updateData->status = '1';
            }

            $updateData->save();

            return response()->json(['success'=>$userId]);
        }
    }

    public function emptyPhoto($id){
        $rowData = User::findOrFail($id);
        $rowData = AdminHelper::DeleteAllPhotos($rowData,true);
        $rowData->save();
        return back();

    }


}



