<?php

namespace App\Http\Requests\Task;

use App\Helpers\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;

class IndexTaskRequest extends FormRequest
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
            'paginate' => ['required', 'integer', 'in:20,30,50,100'],
            'status' => ['integer', 'in:' . TaskStatus::FINISHED . ',' . TaskStatus::IN_PROGRESS . ',' . TaskStatus::PENDING . ',' . TaskStatus::STOP]
        ];
    }
}
