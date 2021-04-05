<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'question_id', 'student_id','teacher_id', 'value', 'course_id',
    ];
}
