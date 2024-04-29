<?php

namespace App\Http\Requests\Goal;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Morilog\Jalali\CalendarUtils;

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

    public function prepareForValidation()
    {
        $start_array = explode('-', (string) $this->start_date, PHP_INT_MAX);
        $end_array = explode('-', (string) $this->do_date, PHP_INT_MAX);
        $this->merge([
            'start_date' => implode('-', CalendarUtils::toGregorian($start_array[0], $start_array[1], $start_array[2])),
            'do_date' => implode('-', CalendarUtils::toGregorian($end_array[0], $end_array[1], $end_array[2])),
        ]);
    }
    public function withValidator($validator)
    {
        User::findOrFail($this->route('user'));
        $validator->after(function ($validator) {
            $this->merge([
                'user_id' => $this->route('user'),
            ]);
        });
    }
}
