<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\ContactContact;
use App\Contact;

class Swimmer extends Model
{

    public function swimmerContact()
    {
        return $this->belongsTo('App\Contact', 'contact_id');
    }

    public function swimmerStatus()
    {
        return $this->belongsTo('App\SwimmerStatus');
    }

    public function swimClass()
    {
        return $this->belongsToMany('App\SwimClass');
    }

    public function scopeActiveSwimmers($query)
    {
        return $query->join('swimmer_statuses', function ($join) {
            $join->on('swimmer_statuses.id', '=', 'swimmer_status_id')
                ->where('swimmer_status', '=', 'current');
        });
    }

    public function scopeFinishedSwimmers($query)
    {
        return $query->join('swimmer_statuses', function ($join) {
            $join->on('swimmer_statuses.id', '=', 'swimmer_status_id')
                ->where('swimmer_status', '=', 'finished');
        });

    }

    public function scopeParentRelationships($query)
    {
        return $query->join('contact_relationship_types',function($join){
            $join->on('contact_contacts', 'contact_contacts.child_contact_id', '=', 'contacts.id')
            ->on('contact_relationship_types', 'contact_contacts.parent_relationship_type_id', '=', 'contact_relationship_types.id');
    });
    }

}