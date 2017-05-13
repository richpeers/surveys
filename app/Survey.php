<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
