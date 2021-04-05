<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Student extends Model
{
    protected $fillable = [
        'first_name', 'last_name','user_id', 'matric_no', 'gender','department_id','email',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function teachers(){
        return $this->hasMany(Teacher::class, 'role_id');
    }
}
