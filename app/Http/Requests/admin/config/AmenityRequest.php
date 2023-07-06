<?php

namespace App\Http\Requests\admin\config;

use Illuminate\Foundation\Http\FormRequest;

class AmenityRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $id = $this->route('id');


        if($id == '0'){
            $rules =[
                'image' => 'mimes:jpeg,jpg,png,gif,webp|max:10000|nullable',
                'filter_id'=> "required_with:image",

            ];
        }else{
            $rules =[
                'image' => 'mimes:jpeg,jpg,png,gif,webp|max:10000|nullable',
                'filter_id'=> "required_with:image",

            ];
        }


        if($id == '0'){
            foreach(config('app.lang_file') as $key=>$lang){
                $rules[$key.".name"] =   'required|unique:amenity_translations,name';
            }
        }else{
            foreach(config('app.lang_file') as $key=>$lang){
               $rules[$key.".name"] =   "required|unique:amenity_translations,name,$id,amenity_id,locale,$key";
            }
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'filter_id.required_with' => 'برجاء تحديد الفلتر',
        ];
    }


}
