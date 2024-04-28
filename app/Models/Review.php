<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        "goal_id",
        "description",
        "question",
        "result_point",
        "result_quality"
    ];

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}
