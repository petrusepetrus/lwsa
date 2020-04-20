<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassStatus extends Model
{
    protected $fillable = [
        'class_status',
    ];

    public function swimClass()
    {
        return $this->hasMany('App\SwimClass');
    }
}
