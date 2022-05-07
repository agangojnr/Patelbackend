<?php

namespace App;

use App\BusinessJobCategory;
use Illuminate\Database\Eloquent\Model;

class BusinessInfo extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'sector_id', 'user_id','contact', 'business_name', 'business_email','physicaladdress','status','description'
    ];

    public $table = 'business_info';


    public function Businesssector(){
        return $this->belongsTo('App\BusinessSector','sector_id');
    }

    public function appuser(){
        return $this->belongsTo('App\AppUsers', 'user_id');
    }

}
