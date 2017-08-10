<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'user_id', 'published_at', 'created_at', 'updated_at'
    ];

    public function questions()
    {
        return $this->hasMany('App\Question')->orderBy('order');
    }

    public function options()
    {
        return $this->hasManyThrough('App\Option', 'App\Question');
    }
}
