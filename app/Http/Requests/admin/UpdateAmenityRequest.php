<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateAmenityRequest extends FormRequest
{
    protected $id;

    public function __construct(Request $request)
    {
        $this->id = $request->id;
    }

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
           // "icon"=> 'required'
        ];

        foreach(config('app.lang_file') as $key=>$lang){
             $rules[$key.".name"] =   "required|unique:amenity_translations,name,$this->id,amenity_id";
        }

        return $rules;
    }
}
