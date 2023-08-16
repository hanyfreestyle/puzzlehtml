<?php

namespace App\Http\Requests\admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UnitRequest extends FormRequest
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
            $rules = ['slug'=> "required|unique:listings"];
        }else{
            $rules =['slug'=> "required|unique:listings,slug,$id"];
        }

        $rules += [
            'location_id'=> "required",
            'property_type'=> "required",
            'unit_status'=> "required",
            'delivery_date'=> "required|integer|min:2000|max:2050",
            'price'=> "required|integer",
            'latitude'=> "nullable|numeric|required_with:longitude",
            'longitude'=> "nullable|numeric|required_with:latitude",
            'youtube_url'=> "nullable|alpha_dash:ascii",
            'view'=> "required",
            'area'=> "required|integer",
            'baths'=> "required|integer",
            'rooms'=> "required|integer",
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
