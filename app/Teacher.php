<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Teacher extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'teacher_id', 'gender','department_id','email', 'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function students(){
        return $this->hasMany(Student::class, 'role_id');
    }
}
