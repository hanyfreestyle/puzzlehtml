<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingFormRequest extends FormRequest
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
        return [
            'facebook'=> 'exclude_if:facebook,#|required|url',
            'twitter'=> 'exclude_if:twitter,#|required|url',
            'youtube'=> 'exclude_if:youtube,#|required|url',
            'instagram'=> 'exclude_if:instagram,#|required|url',
            'google_api'=> 'exclude_if:google_api,#|required',
        ];
    }
}
