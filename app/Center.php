<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    public $table = 'centers';
    protected $fillable = [
        'id', 'center_name', 'country_id', 'center_code', 'assigned'
    ];


 public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }

}
