<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'rating_activation'
    ];
    public function teachers(){
        return $this->hasMany(Teacher::class, 'role_id');
    }
    public function students(){
        return $this->hasMany(Student::class, 'role_id');
    }
}
