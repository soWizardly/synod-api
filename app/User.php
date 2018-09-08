<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends BaseModel implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = "user";
    protected $fillable = ['id', 'name', 'email', 'password', 'type', 'created_at', 'updated_at'];
    protected $hidden = [
        'password', 'token'
    ];

    public function proposals()
    {
        return $this->hasMany('App\Proposal');
    }

    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
