<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Enums\TaskWeight;

class CreateTaskRequest extends FormRequest
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
            'title' => ['required', 'string' ,'min:3'],
            'description' => ['required', 'string','min:10'],
            'weight' => ['required', 'integer', 'in:' . TaskWeight::CRITICAL . ',' . TaskWeight::HIGH . ',' . TaskWeight::LOW . ',' . TaskWeight::MEDIUM . ',' . TaskWeight::MINIMAL],
        ];

    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->merge([
                'goal_id' => $this->route('goal'),
            ]);
        });
    }
}
