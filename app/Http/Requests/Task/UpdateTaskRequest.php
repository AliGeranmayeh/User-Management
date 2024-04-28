<?php

namespace App\Http\Requests\Task;

use App\Helpers\Enums\TaskWeight;
use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Enums\TaskStatus;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['string'],
            'description' => ['string'],
            'weight' => ['integer', 'in:' . TaskWeight::CRITICAL . ',' . TaskWeight::HIGH . ',' . TaskWeight::LOW . ',' . TaskWeight::MEDIUM . ',' . TaskWeight::MINIMAL],
            'status' => ['integer', 'in:' . TaskStatus::FINISHED . ',' . TaskStatus::IN_PROGRESS . ',' . TaskStatus::PENDING . ',' . TaskStatus::STOP]
        ];
    }
}
