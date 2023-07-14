<?php

namespace App\Http\Controllers\admin\roles;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\config\AmenityRequest;
use App\Http\Requests\admin\roles\AdminPermissionRequest;
use App\Models\admin\config\Amenity;
use App\Models\admin\config\AmenityTranslation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminPermissionController extends AdminMainController
{
    public $controllerName = 'permissions';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index()
    {
        $sendArr = ['TitlePage' => __('admin/menu.roles_permissions') ,'selMenu'=> 'users.'];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";


        $rowData = Permission::orderBy('id')->paginate(10);
        return view('admin.role.permission_index',compact('pageData','rowData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create()
    {
        $sendArr = ['TitlePage' => __('admin/menu.roles_permissions'),'selMenu'=> 'users.'];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Add";

        $rowData = Permission::findOrNew(0);
        $roles = Role::all();
       return view('admin.role.permission_form',compact('pageData','rowData','roles'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.roles_permissions') ,'selMenu'=> 'users.' ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $rowData = Permission::findOrFail($id);
        $roles = Role::all();
        return view('admin.role.permission_form',compact('rowData','pageData','roles'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(AdminPermissionRequest $request, $id=0)
    {
        $request-> validated();
        $saveData =  Permission::findOrNew($id);
        $saveData->name = $request->name;

        $saveData->name_ar =  $request->name_ar;
        $saveData->name_en =  $request->name_en;

        $saveData->save();

        if($id == '0'){
            return redirect(route('users.permissions.index'))->with('Add.Done',"");
        }else{
            return redirect(route('users.permissions.index'))->with('Edit.Done',"");
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id)
    {
        $deleteRow = Permission::findOrFail($id);
        $deleteRow->delete();
        return redirect(route('users.permissions.index'))->with('confirmDelete',"");
    }

    public function assignRole(Request $request , Permission $permission){

        if($permission->hasRole($request->role)){
            return back()->with('mass','موجوده');
        }
        $permission->assignRole($request->role);
        return back()->with('mass2','موجوده');

    }

    public function removeRole(Permission $permission , Role $role){
        if($permission->hasRole($role)){
            $permission->removeRole($role);
            return back()->with('mass9','موجوده');
        }

    }






}
