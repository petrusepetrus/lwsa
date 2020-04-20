<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SwimmerStatus extends Model
{
    public function swimmers(){
        return $this-hasMany('App\Swimmer');
    }

    public function scopeSwimmerStatus($query, $value)
    {
        return $query->select('id')
            ->where('swimmer_status',$value);
;
    }
}
