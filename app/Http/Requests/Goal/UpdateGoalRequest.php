<?php

namespace App\Http\Requests\Goal;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGoalRequest extends FormRequest
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
            'title' => ['string', 'min:3'],
            'description' => ['string', 'min:10'],
            'start_date' => ['date'],
            'end_data' => ['date', 'after_or_equal:start_date'],
            'do_date' => ['date', 'after_or_equal:start_date'],
        ];
    }
}
