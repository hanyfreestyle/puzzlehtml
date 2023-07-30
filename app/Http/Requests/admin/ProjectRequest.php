<?php

namespace App\Http\Requests\admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProjectRequest extends FormRequest
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
                'slug'=> "required|unique:listings",

            ];
        }else{
            $rules =[
                'slug'=> "required|unique:listings,slug,$id",

            ];
        }

        $rules += [
            'location_id'=> "required",
            'developer_id'=> "required",
            'project_type'=> "required",
            'status'=> "required",
            'price'=> "required",
            'delivery_date'=> "required",
            'amenity' => "required|array|min:3",
        ];

        foreach(config('app.lang_file') as $key=>$lang){
            $rules[$key.".name"] =   'required';
            $rules[$key.".g_title"] =   'required';
            $rules[$key.".g_des"] =   'required';
            $rules[$key.".des"] =   'required';
        }

        return $rules;
    }
}
