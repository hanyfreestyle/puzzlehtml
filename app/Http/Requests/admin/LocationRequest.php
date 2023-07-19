<?php

namespace App\Http\Requests\admin;

use Illuminate\Http\Request;
use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(Request $request): array
    {
        $request->slug = AdminHelper::Url_Slug($request->slug) ;


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
