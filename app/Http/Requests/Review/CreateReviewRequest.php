<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Enums\ReviewQuality;

class CreateReviewRequest extends FormRequest
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
            'description' => ['required', 'string'],
            "question"=> ['required', 'string'],,
            "result_quality" => ['required', 'string' , 'in:'.ReviewQuality::PERFECT. ',' .ReviewQuality::OK. ',' .ReviewQuality::GOOD. ',' .ReviewQuality::BAD],
            'result_point' => ['required' , 'integer','in:1,2,3,4,5']
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
