<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['first_name', 'last_name', 'full_name'];

    //protected $with =['parentContacts'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function swimmerContact()
    {
        $this->hasOne(Swimmer::class);
    }

    public function contactType()
    {
        return $this->hasMany(ContactType::class);
    }

    public function parentContactContact()
    {
        return $this->hasOne('App\ContactContact','id','child_contact_id');
    }

    public function childContacts()
    {
        return $this->belongsToMany('App\Contact', 'contact_contacts', 'parent_contact_id', 'child_contact_id')
            ->withPivot('child_relationship_type_id')
            ->join('contact_relationship_types','child_relationship_type_id','contact_relationship_types.id')
            ->select('contacts.*','relationship_type');
    }

    public function parentContacts()
    {
        return $this->belongsToMany('App\Contact', 'contact_contacts', 'child_contact_id', 'parent_contact_id')
            ->withPivot('parent_relationship_type_id')
            ->join('contact_relationship_types','parent_relationship_type_id','contact_relationship_types.id')
            ->select('contacts.*','relationship_type');
    }

    public function scopeParentRelationships($query)
    {
        return $query->select('contact_relationship_types.*')
            ->join('contacts','contacts.id','=','swimmers.contact_id')
            ->join('contact_contacts','contact_contacts.child_contact_id','=','contacts.id')
            ->join('contact_relationship_types','contact_contacts.parent_relationship_type_id','=','contact_relationship_types.id');
    }


    /**
     * Set the  first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst($value);
    }

    /**
     * Set the  last name.
     *
     * @param  string  $value
     * @return void
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst($value);
    }
    /**
     * Set the  last name.
     *
     * @param  string  $value
     * @return void
     */
    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = ucwords($value);
    }
}