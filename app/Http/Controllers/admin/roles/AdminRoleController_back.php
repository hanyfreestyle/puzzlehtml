<?php

namespace App\Http\Controllers\admin\roles;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;


use App\Http\Requests\admin\roles\AdminRoleRequest;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class AdminRoleController extends AdminMainController
{
    public $controllerName = 'roles';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index()
    {
        $sendArr = ['TitlePage' => __('admin/menu.roles_role') ,'selMenu'=> 'users.' ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";

        $rowData = Role::orderBy('id')->paginate(10);
        return view('admin.role.role_index',compact('pageData','rowData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create()
    {
        $sendArr = ['TitlePage' => __('admin/menu.roles_role'),'selMenu'=> 'users.' ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Add";

       $rowData = Role::findOrNew(0);
        return view('admin.role.role_form',compact('pageData','rowData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.roles_role'),'selMenu'=> 'users.' ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $rowData = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('admin.role.role_form',compact('rowData','pageData',"permissions"));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(AdminRoleRequest $request, $id=0)
    {
        $request-> validated();

        $saveData =  Role::findOrNew($id);
        $saveData->name = $request->name;


        $saveData->save();

        if($id == '0'){
            return redirect(route('users.roles.index'))->with('Add.Done',"");
        }else{
            return redirect(route('users.roles.index'))->with('Edit.Done',"");
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id)
    {
        $deleteRow = Role::findOrFail($id);
        $deleteRow->delete();
        return redirect(route('users.roles.index'))->with('confirmDelete',"");
    }


    public function givePermission(Request $request , Role $role){

        if($role->hasPermissionTo($request->permission)){
            return back()->with('mass','موجوده');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('mass2','موجوده');
    }


    public function removePermission(Role $role , Permission $permission){
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);

            return back()->with('mass9','موجوده');
        }
    }








}
