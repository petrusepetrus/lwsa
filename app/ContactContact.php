<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactContact extends Model
{
    protected $with =['parentRelationshipTypes','childRelationshipTypes'];

    public function parentRelationshipTypes()
    {
        $this->hasMany(ContactRelationshipType::class,'parent_relationship_type_id');
    }

    public function childRelationshipTypes()
    {
        $this->hasMany(ContactRelationshipType::class, 'child_relationship_type_id');
    }

    public function childContact()
    {
        $this->belongsTo(Contact::class,'child_contact_id');
    }

    public function parentContact()
    {
        $this->belongsTo(Contact::class,'parent_contact_id');
    }

}

