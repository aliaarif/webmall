<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    const ROLE_VISITOR = 1;
    const ROLE_USER = 2;
    const ROLE_MANAGER = 3;
    const ROLE_ADMIN = 4;
    const ROLE_DEACTIVATED = 5;
    const ROLE_OVERSEAS_MANAGER = 6;
    const ROLE_SALES_STAFF = 7;
    const ROLE_BIDDER = 8;
    const AFFILIATE = 9;
    const SUPPLIER = 10;

    public function users() {

        return $this->belongsToMany(User::class,'role_user', 'role_id', 'user_id');

    }
}
