<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\QuestionRequest;
use App\Models\admin\Listing;
use App\Models\admin\Question;
use App\Models\admin\QuestionTranslation;


class QuestionController extends AdminMainController
{
    public $controllerName ;

    function __construct($controllerName = 'project')
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
#|||||||||||||||||||||||||||||||||||||| #     FaqList
    public  function FaqList($id){

        $sendArr = ['TitlePage' => __('admin/menu.project') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";

        $Trashed = Question::onlyTrashed()->where('project_id','=',$id)->count();
        $ProjectQuestion = Question::where('project_id','=',$id)->paginate(10);
        $Project = Listing::findOrFail($id) ;

        return view('admin.listing.faq_index',compact('ProjectQuestion','pageData','Project','Trashed'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     FaqSoftDeletes
    public function FaqSoftDeletes ($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.project') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "deleteList";
        $Project = Listing::findOrFail($id) ;
        $ProjectQuestion = Question::onlyTrashed()->where('project_id','=',$id)->paginate(10);
        return view('admin.listing.faq_index',compact('pageData','Project','ProjectQuestion'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Restore
    public function FaqRestore($id)
    {
        Question::onlyTrashed()->where('id',$id)->restore();
        return back()->with('restore',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function FaqForceDeletes($id)
    {
        $deleteRow =  Question::onlyTrashed()->where('id',$id)->first();
        $deleteRow->forceDelete();
        return back()->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Faqdestroy
    public function Faqdestroy($id)
    {
        $deleteRow = Question::findOrFail($id);
        $deleteRow->delete();
        return redirect(route('project.faq_list',$deleteRow->project_id))->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     FaqCreate
    public function FaqCreate($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.project') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Add";

        $Project = Listing::findOrFail($id) ;
        $ProjectQuestion = Question::findOrNew(0);
        return view('admin.listing.faq_form',compact('ProjectQuestion','pageData','Project'));

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Faqedit
    public function Faqedit($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.project') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $ProjectQuestion = Question::findOrFail($id);
        $Project = Listing::findOrFail($ProjectQuestion->project_id) ;

        return view('admin.listing.faq_form',compact('pageData','Project','ProjectQuestion'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function FaqstoreUpdate(QuestionRequest $request, $id=0)
    {

        $saveData =  Question::findOrNew($id);
        $saveData->project_id = $request->input('project_id');
        $saveData->save();

        foreach ( config('app.lang_file') as $key=>$lang) {
            $saveTranslation = QuestionTranslation::where('question_id',$saveData->id)
                ->where('locale',$key)
                ->firstOrNew();
            $saveTranslation->question_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->question = $request->input($key.'.question');
            $saveTranslation->answer = $request->input($key.'.answer');
            $saveTranslation->save();
        }

        if($id == '0'){
            return redirect(route('project.faq_list',$request->input('project_id')))->with('Add.Done',"");
        }else{
            return redirect(route('project.faq_list',$request->input('project_id')))->with('Edit.Done',"");
        }
    }

}
