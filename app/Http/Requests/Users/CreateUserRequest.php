<?php

namespace App\Http\Requests\Users;

use App\Helpers\Enums\RoleType;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','string' , 'min:3'],
            'email' => ['required' , 'email' , 'unique:users,email'],
            'password' => ['required' , 'string', 'confirmed', 'min:8'],
            'personal_code' => ['required' , 'integer'],
            'image' => ['required' ,'mimes:png,jpg,jpeg'],
            // 'role_id' => ['required','in:'.RoleType::ADMIN.','.RoleType::EMPLOYEE]
        ];
    }
}
