<?php

namespace App\Http\Requests\admin\roles;

use Illuminate\Foundation\Http\FormRequest;

class AdminRoleRequest extends FormRequest
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
                'name'=> "required|alpha_dash:ascii|min:4|max:50|unique:roles",
            ];
        }else{
            $rules =[
                'name'=> "required|alpha_dash:ascii|min:4|max:50|unique:roles,name,$id",
            ];
        }

        return $rules;
    }
}