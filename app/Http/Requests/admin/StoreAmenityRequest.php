<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmenityRequest extends FormRequest
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
           // 'dd' => 'required|unique:amenity_translations',
        ];

        foreach(config('app.lang_file') as $key=>$lang){
            $rules[$key.".name"] =   'required|unique:amenity_translations,name';
        }

        return $rules;
    }
}
