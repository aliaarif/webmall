<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    const TYPE_INDIVIDUAL   = 0;
    const TYPE_PROFESSIONAL = 1;
    const TYPE_OTHER        = 2;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}