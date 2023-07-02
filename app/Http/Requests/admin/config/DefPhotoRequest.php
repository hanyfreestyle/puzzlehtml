<?php

namespace App\Http\Requests\admin\config;

use Illuminate\Foundation\Http\FormRequest;

class DefPhotoRequest extends FormRequest
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
                'cat_id'=> "required|alpha_dash:ascii|min:4|max:50|unique:config_def_photos",
            ];
        }else{
            $rules =[
               'cat_id'=> "required|alpha_dash:ascii|min:4|max:50|unique:config_def_photos,cat_id,$id",
            ];
        }
        return $rules;
    }
}
