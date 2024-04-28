<?php

namespace App\Http\Requests\Goal;

use Illuminate\Foundation\Http\FormRequest;

class CreateGoalRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3'],
            'description' => ['required', 'string', 'min:10'],
            'start_date' => ['required', 'date'],
            'do_date' => ['required', 'date', 'after_or_equal:start_date'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->merge([
                'user_id' => $this->route('user'),
            ]);
        });
    }
}
