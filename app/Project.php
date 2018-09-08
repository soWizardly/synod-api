<?php

namespace App;

class Project extends BaseModel
{

    protected $table = "project";
    protected $attributes = ['id', 'user_id', 'name', 'content', 'created_at', 'updated_at'];
    protected $fillable = ['id', 'user_id', 'name', 'content', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function proposals()
    {
        return $this->hasMany('App\Proposal');
    }
}
