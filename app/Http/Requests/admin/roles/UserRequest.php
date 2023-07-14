<?php

namespace App\Http\Requests\admin\roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password ;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $id = $this->route('id');

        if($id == '0'){
            $rules =[
                //'name'=> "required|alpha_dash:ascii|min:4|max:50|unique:roles",
                'name'=> "required|min:4|max:50",
                'roles' => 'required',
                'email'=> "required|email|unique:users",
                'phone'=> "numeric|nullable",
                'user_password'=> "required|confirmed|min:8",
                'image' => 'mimes:jpeg,jpg,png,gif,webp|max:10000|nullable',
/*
                'user_password' => ['required', Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                ],
*/
            ];
        }else{
            $rules =[
                'name'=> "required|min:4|max:50",
                'roles' => 'required',
                'email'=> "required|email|unique:users,email,$id",
                'phone'=> "numeric|nullable",
                'user_password'=> "confirmed|min:8|nullable",
                'image' => 'mimes:jpeg,jpg,png,gif,webp|max:10000|nullable',

            ];
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'roles.required' => __('admin/config/roles.users_fr_role_selone'),
        ];
    }

}
