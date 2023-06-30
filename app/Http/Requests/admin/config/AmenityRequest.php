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
        $rules =[
           //'dd' => 'required|unique:amenity_translations',
        ];

        $id = $this->route('id');

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
}
