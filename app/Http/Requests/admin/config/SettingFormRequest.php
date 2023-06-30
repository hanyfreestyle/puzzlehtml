<?php

namespace App\Http\Requests\admin\config;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class SettingFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $rules =[
            'facebook'=> 'exclude_if:facebook,#|required|url',
            'twitter'=> 'exclude_if:twitter,#|required|url',
            'youtube'=> 'exclude_if:youtube,#|required|url',
            'instagram'=> 'exclude_if:instagram,#|required|url',
            'google_api'=> 'exclude_if:google_api,#|required',
        ];

        foreach(config('app.lang_file') as $key=>$lang){
            $rules[$key.".name"] =   'required';
            $rules[$key.".g_title"] =   'required';
            $rules[$key.".g_des"] =   'required';
            $rules[$key.".closed_mass"] =   'required';
        }
        return $rules;
    }
}
