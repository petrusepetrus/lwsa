<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactRelationshipType extends Model
{
    public function parentRelationshipType()
    {
        return $this->belongsTo('ContactContact','parent_relationship_type_id','id');
    }

    public function childRelationshipType()
    {
        return $this->belongsTo('ContactContact','child_relationship_type_id','relationship_type_id');
    }

}

