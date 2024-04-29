<?php

namespace App\Http\Requests\Goal;

use Illuminate\Foundation\Http\FormRequest;
use Morilog\Jalali\CalendarUtils;

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


    public function prepareForValidation()
    {
        if ($this->has('start_date')) {
            $start_array = explode('-', (string) $this->start_date, PHP_INT_MAX);
            $this->merge([
                'start_date' => implode('-', CalendarUtils::toGregorian($start_array[0], $start_array[1], $start_array[2])),
            ]);
        }

        if ($this->has('end_date')) {
            $end_array = explode('-', (string) $this->end_date, PHP_INT_MAX);
            $this->merge([
                'end_date' => implode('-', CalendarUtils::toGregorian($end_array[0], $end_array[1], $end_array[2])),
            ]);
        }

        if ($this->has('do_date')) {
            $do_date_array = explode('-', (string) $this->do_date, PHP_INT_MAX);
            $this->merge([
                'start_date' => implode('-', CalendarUtils::toGregorian($do_date_array[0], $do_date_array[1], $do_date_array[2])),
            ]);
        }

    }
}
