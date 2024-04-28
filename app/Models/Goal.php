<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
