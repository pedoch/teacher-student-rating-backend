<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionToken extends Model
{
    protected $fillable = [
        'user_id', 'token', 'expired_at',
    ];
}
