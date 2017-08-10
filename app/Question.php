<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    protected $hidden = ['survey_id', 'created_at', 'updated_at', 'deleted_at'];

    public function options()
    {
        return $this->hasMany('App\Option')->orderBy('order');
    }
}
