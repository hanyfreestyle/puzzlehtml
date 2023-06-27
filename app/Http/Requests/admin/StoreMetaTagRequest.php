<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMetaTagRequest extends FormRequest
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
    public function rules(): array
    {
        $rules =[
            'cat_id'=> 'required|alpha_dash:ascii|min:4|max:50|unique:meta_tags',

        ];

        foreach(config('app.lang_file') as $key=>$lang){

            $rules[$key.".g_title"] =   'required';
            $rules[$key.".g_des"] =   'required';



        }

        return $rules;

    }
}
