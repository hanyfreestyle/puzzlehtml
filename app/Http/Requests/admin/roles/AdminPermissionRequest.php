<?php

namespace App\Http\Requests\admin\roles;

use Illuminate\Foundation\Http\FormRequest;

class AdminPermissionRequest extends FormRequest
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
        $id = $this->route('id');

        if($id == '0'){
            $rules =[
                'name'=> "required|alpha_dash:ascii|min:4|max:50|unique:permissions",
            ];
        }else{
            $rules =[
                'name'=> "required|alpha_dash:ascii|min:4|max:50|unique:permissions,name,$id",
            ];
        }

        return $rules;
    }
}
