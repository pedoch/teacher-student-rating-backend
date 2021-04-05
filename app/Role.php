<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
    ];
    public static $A = 1;
    public static $T = 2;
    public static $S = 3;

    public function users(){
        return $this->hasMany(User::class, 'role_id');
    }
}
