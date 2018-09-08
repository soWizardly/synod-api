<?php

namespace App;

class Proposal extends BaseModel
{

    protected $table = "proposal";
    protected $attributes = ['id', 'user_id', 'project_id', 'name', 'content', 'created_at', 'updated_at'];
    protected $fillable = ['id', 'user_id', 'project_id', 'name', 'content', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function project()
    {
        return $this->belongsTo('App\User');
    }
}
