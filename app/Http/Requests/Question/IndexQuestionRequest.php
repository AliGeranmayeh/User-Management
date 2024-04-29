<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class IndexQuestionRequest extends FormRequest
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
            'paginate' => ['integer', 'in:20,30,50,100'],
            'question' => ['string'],
        ];
    }
}
