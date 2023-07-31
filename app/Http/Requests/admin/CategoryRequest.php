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

    protected function prepareForValidation()
    {
        $this->merge([
            'slug'=> AdminHelper::Url_Slug($this->get('slug')),
        ]);
    }


    public function rules(Request $request): array
    {
       $request->merge(['slug' => AdminHelper::Url_Slug($request->slug)]);

       $id = $this->route('id');

        if($id == '0'){
            $rules =[
                'slug'=> "required|unique:categories",
            ];
        }else{
            $rules =[
                'slug'=> "required|unique:categories,slug,$id",
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
