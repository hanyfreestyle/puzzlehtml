<?php

namespace App\Http\Requests\admin;

use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Str;

class CategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {

       $request->slug = AdminHelper::Url_Slug($request->slug) ;


        $id = $this->route('id');

        if($id == '0'){
            $rules =[
                'slug'=> "required|unique:categories",
                //'is_active'=> "required",
            ];
        }else{
            $rules =[
                'slug'=> "required|unique:categories,slug,$id",
                //'is_active'=> "required",
            ];
        }

        foreach(config('app.lang_file') as $key=>$lang){
            $rules[$key.".name"] =   'required';
            $rules[$key.".g_title"] =   'required';
            $rules[$key.".g_des"] =   'required';
        }

        return $rules;
    }
}
