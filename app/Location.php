<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'location', 'location_abbr',
    ];

    public function swimClass()
    {
        return $this->hasMany('App\SwimClass');
    }
}
