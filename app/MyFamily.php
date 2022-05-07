<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyFamily extends Model
{


    protected $dates = [
        'created_at',
        'updated_at',
        'dob',
    ];
    protected $fillable = [
        'relative_id', 'dob', 'mname', 'relation', 'bgroup', 'memail', 'mobile_no', 'native_place','nationality', 'image_url', 'unique_member_id', 'user_id', 'sports_registered',
    ];

    public $table = 'relatives';

    public function Native()
    {
        return $this->hasOne('App\Native', 'native_id', 'native_place');
    }

    public function Relation()
    {
        return $this->hasOne('App\Relation', 'relation_id', 'relation');
    }
    public function Sport()
    {
        return $this->hasOne('App\Sport', 'sport_id', 'sports_registered');
    }

}
