<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    //
    protected $dates = [
        'created_at',
        'updated_at',

    ];


     protected $fillable = [
       'secondedby', 'proposedby' ,'nationality' ,'member_type', 'physical_address', 'pwork_address','user_id', 'unique_id', 'town', 'rcenter', 'country', 'native', 'firstname', 'midname', 'surname', 'gender', 'email', 'birthday', 'bloodgroup', 'mobile', 'marital', 'boxno', 'pcode', 'pwork', 'business', 'address', 'family_code', 'pbhno', 'nation_code', 'pbhconfirm', 'inv_status', 'user_code', 'bureau', 'insurance', 'attend', 'sports', 'cultural', 'accomodation', 'payment_id', 'sports_registered', 'photo_url',
    ];

    public $table = 'members';

    public function Rcenter()
    {
        return $this->hasOne('App\Center', 'id', 'rcenter');
    }

     public function Native()
    {
        return $this->hasOne('App\Native', 'native_id', 'native');
    }
    public function County()
    {
        return $this->hasOne('App\Country', 'id', 'sports_registered');
    }

    public function Sport()
    {
        return $this->hasOne('App\Sport', 'sport_id', 'sports_registered');
    }
     public function Town()
    {
        return $this->hasOne('App\Town', 'town_id', 'town');
    }

    public function Request(){
        return $this->hasMany('App\MemberRequest', 'user_id', 'user_id');
    }

    public function Nationality()
    {
        return $this->hasOne('App\Country', 'id', 'nationality');
    }

    public function Country()
    {
        return $this->hasOne('App\Country', 'id', 'country');
    }

    public function Payment()
    {
        return $this->hasMany('App\Payment', 'payment_id', 'user_id');
    }

    public function appuser()
    {
        return $this->hasOne('App\AppUsers', 'memberid');
    }

}
