<?php

namespace App\Http\Requests\admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PostRequest extends FormRequest
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
                'slug'=> "required|unique:posts",

            ];
        }else{
            $rules =[
                'slug'=> "required|unique:posts,slug,$id",

            ];
        }

        foreach(config('app.lang_file') as $key=>$lang){
            $rules[$key.".name"] =   'required';
            $rules[$key.".g_title"] =   'required';
            $rules[$key.".g_des"] =   'required';
            $rules[$key.".des"] =   'required';
        }

        return $rules;
    }
}
