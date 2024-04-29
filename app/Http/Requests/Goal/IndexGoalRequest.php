<?php

namespace App\Http\Requests\Goal;

use Illuminate\Foundation\Http\FormRequest;
use Morilog\Jalali\CalendarUtils;

class IndexGoalRequest extends FormRequest
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
            'start' => ['date'],
            'end' => ['date', 'after_or_equal:start'],
            'type' => ['string', 'in:do_date,start_date,end_date']
        ];
    }

    public function prepareForValidation()
    {
        if ($this->has('type')) {
            $start_array = explode('-', (string) $this->start, PHP_INT_MAX);
            $end_array = explode('-', (string) $this->end, PHP_INT_MAX);
            $this->merge([
                'start' => implode('-', CalendarUtils::toGregorian($start_array[0], $start_array[1], $start_array[2])),
                'end' => implode('-', CalendarUtils::toGregorian($end_array[0], $end_array[1], $end_array[2])),
            ]);
        }
    }
}
