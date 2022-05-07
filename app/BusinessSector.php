<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessSector extends Model
{
   protected $table = 'business_sectors';

   protected $fillable = [
    'id', 'sector_name','sector_description','created_by','created_at','updated_at'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'created_by');
    }

    public function Businessinfo(){
        return $this->hasMany('App\BusinessInfo', 'sector_id');
    }

    public function Jobtitle()
    {
        return $this->hasMany('App\JobTitle', 'sector_id');
    }
}
