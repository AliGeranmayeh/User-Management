<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => ['string', 'min:3'],
            'email' => ['email', 'unique:users,email'],
            'password' => ['string', 'confirmed', 'min:8'],
            'personal_code' => ['integer'],
            'image' => ['mimes:png,jpg,jpeg'],
            // 'role_id' => ['required','in:'.RoleType::ADMIN.','.RoleType::EMPLOYEE]
        ];
    }

    protected function passedValidation()
    {

        if ($this->has('image')) {
            $user = auth()->user();

            $image = $this->file('image');

            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the uploaded image in the destination directory
            $image->storeAs("public/profile/", $fileName);

            $this->image = "profile/{$user->id}/{$fileName}";
        }

    }
}
