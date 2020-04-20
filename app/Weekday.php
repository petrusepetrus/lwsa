<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weekday extends Model
{
    protected $fillable = [
        'weekday', 'weekday_short', 'weekday_abbr', 'weekday_number'
    ];

    public function swimClass()
    {
        return $this->hasMany('App\SwimClass');
    }
}
