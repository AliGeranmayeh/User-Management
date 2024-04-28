<?php

namespace App\Http\Requests\Review;

use App\Helpers\Enums\ReviewQuality;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
            'description' => ['string'],
            "question" => ['string'], ,
            "result_quality" => ['string', 'in:' . ReviewQuality::PERFECT . ',' . ReviewQuality::OK . ',' . ReviewQuality::GOOD . ',' . ReviewQuality::BAD],
            'result_point' => ['integer', 'in:1,2,3,4,5']
        ];
    }
}
