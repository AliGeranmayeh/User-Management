<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\CalendarUtils;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'do_date',
        'point',
        'user_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'do_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getStartDateAttribute($value)
    {
        $date = date('Y-m-d', strtotime($value));
        $date_array = explode('-', (string) $date, PHP_INT_MAX);

        return implode('-', CalendarUtils::toJalali($date_array[0], $date_array[1], $date_array[2]));
    }

    public function setStartDateAttribute($value)
    {
        $date_array = explode('-', (string) $value, PHP_INT_MAX);
        $this->attributes['start_date'] = implode('-', CalendarUtils::toGregorian($date_array[0], $date_array[1], $date_array[2]));
    }

    public function getDoDateAttribute($value)
    {
        $date = date('Y-m-d', strtotime($value));
        $date_array = explode('-', (string) $date, PHP_INT_MAX);

        return implode('-', CalendarUtils::toJalali($date_array[0], $date_array[1], $date_array[2]));
    }

    public function setDoDateAttribute($value)
    {
        $date_array = explode('-', (string) $value, PHP_INT_MAX);
        $this->attributes['start_date'] = implode('-', CalendarUtils::toGregorian($date_array[0], $date_array[1], $date_array[2]));
    }

    public function getEndDateAttribute($value)
    {
        if ($value) {
            $date = date('Y-m-d', strtotime($value));
            $date_array = explode('-', (string) $date, PHP_INT_MAX);

            return implode('-', CalendarUtils::toJalali($date_array[0], $date_array[1], $date_array[2]));
        }
    }

    public function setEndDateAttribute($value)
    {
        if ($value) {
            $date_array = explode('-', (string) $value, PHP_INT_MAX);
            $this->attributes['start_date'] = implode('-', CalendarUtils::toGregorian($date_array[0], $date_array[1], $date_array[2]));
        }
    }
}
