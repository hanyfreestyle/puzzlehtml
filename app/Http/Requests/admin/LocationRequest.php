<?php

namespace App\Http\Requests\admin;

use Illuminate\Http\Request;
use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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

        $rules =[
            'latitude'=> "nullable|numeric|required_with:longitude",
            'longitude'=> "nullable|numeric|required_with:latitude",
        ];

        if($id == '0'){
            $rules +=[
                'slug'=> "required|unique:locations",
            ];
        }else{
            $rules +=[
                'slug'=> "required|unique:locations,slug,$id",
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
