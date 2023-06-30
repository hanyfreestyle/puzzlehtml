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
        return [

        ];
    }
}
