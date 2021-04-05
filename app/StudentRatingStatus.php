<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentRatingStatus extends Model
{
    protected $fillable = [
        'student_id', 'teacher_id', 'status',
    ];
}
