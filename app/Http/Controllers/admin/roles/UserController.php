<?php

namespace App\Http\Controllers\admin\roles;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\config\AmenityRequest;
use App\Http\Requests\admin\roles\UserRequest;
use App\Models\admin\config\Amenity;
use App\Models\admin\config\AmenityTranslation;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends AdminMainController
{
    public $controllerName = 'users';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index()
    {
        $sendArr = ['TitlePage' => __('admin/page.new_page') ,'selMenu'=> 'users.'];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";


        $rowData = User::orderBy('id')->paginate(10);

        return view('admin.role.user_index',compact('pageData','rowData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create()
    {
        $sendArr = ['TitlePage' => __('admin/page.new_page'),'selMenu'=> 'users.'];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Add";

        $rowData = User::findOrNew(0);
        return view('admin.role.user_form',compact('pageData','rowData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id)
    {
        $sendArr = ['TitlePage' => __('admin/page.new_page') ,'selMenu'=> 'users.' ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $rowData = User::findOrFail($id);
        return view('admin.role.user_form',compact('rowData','pageData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(UserRequest $request, $id=0)
    {

        $request-> validated();

        $saveData =  User::findOrNew($id);
        $saveData->name = $request->name;

        $saveData->save();


        if($id == '0'){
            return  back()->with('Add.Done',"");
        }else{
            return  back()->with('Edit.Done',"");
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id)
    {

        /*
        $deleteRow = Amenity::findOrFail($id);
        $deleteRow = AdminHelper::onlyDeletePhotos($deleteRow,2);
        $deleteRow->delete();
        */

        return redirect(route('users.users.index'))->with('confirmDelete',"");
    }

}
