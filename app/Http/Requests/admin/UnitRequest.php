<?php

namespace App\Http\Requests\admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        $request->slug = AdminHelper::Url_Slug($request->slug) ;

        $id = $this->route('id');



        if($id == '0'){
            $rules = [
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
            'property_type'=> "required",
            'unit_status'=> "required",
            'price'=> "required",
            'view'=> "required",
            'area'=> "required",
            'baths'=> "required",
            'rooms'=> "required",
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
