<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UserDetail;
use App\Models\LibraryPayment;
use Laravel\Cashier\Billable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, Billable;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function orders(){
      return $this->hasMany(Order::class);
  }

    public function details()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    public function charges()
    {
        return $this->hasMany(LibraryPayment::class, 'user_id');
    }


    public function roles()
    {
        return $this
            ->belongsToMany('App\Models\Role')
            ->withTimestamps();
    }
    

    public function users()
    {
        return $this
            ->belongsToMany('App\Models\User')
            ->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
      if ($this->hasAnyRole($roles)) {
        return true;
      }
      abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles)
    {
      if (is_array($roles)) {
        foreach ($roles as $role) {
          if ($this->hasRole($role)) {
            return true;
          }
        }
      } else {
        if ($this->hasRole($roles)) {
          return true;
        }
      }
      return false;
    }

    public function hasRole($role)
    {
      if ($this->roles()->where(‘name’, $role)->first()) {
        return true;
      }
      return false;
    }

}
