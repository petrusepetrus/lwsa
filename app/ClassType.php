<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassType extends Model
{
    protected $fillable = [
        'class_type', 'class_type_abbr',
    ];

    public function swimClass()
    {
        return $this->belongsTo('App\SwimClass');
    }
}
