<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SwimClass extends Model
{
    public function classType()
    {
        return $this->hasOne('App\ClassType');
    }

    public function classStatus()
    {
        return $this->hasOne('App\ClassStatus');
    }

    public function location()
    {
        return $this->hasOne('App\Location');
    }

    public function weekday()
    {
        return $this->hasOne('App\Weekday');
    }

    public function swimmers(){
        return $this->belongsToMany('App\Swimmer');
    }
}
