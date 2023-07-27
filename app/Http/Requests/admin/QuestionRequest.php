<?php

namespace App\Http\Requests\admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class QuestionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {

        foreach(config('app.lang_file') as $key=>$lang){
            $rules[$key.".question"] =   'required';
            $rules[$key.".answer"] =   'required';
        }

        return $rules;
    }
}
