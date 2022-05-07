<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Application extends Model
{
    protected $table = 'members';

    protected $fillable = [
        'user_id','secondedby', 'proposedby' ,'nationality' ,'member_type', 'physical_address', 'pwork_address','user_id', 'unique_id', 'town', 'rcenter', 'country', 'native', 'firstname', 'midname', 'surname', 'gender', 'email', 'birthday', 'bloodgroup', 'mobile', 'marital', 'boxno', 'pcode', 'pwork', 'business', 'address', 'family_code', 'pbhno', 'nation_code', 'pbhconfirm', 'inv_status', 'user_code', 'bureau', 'insurance', 'attend', 'sports', 'cultural', 'accomodation', 'payment_id', 'sports_registered', 'photo_url',
     ];

    public function getMemberTypeAttribute($value){
        return Str::title($value);
    }

}
