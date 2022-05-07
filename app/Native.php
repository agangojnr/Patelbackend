<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Native extends Model
{
    public $table = 'natives';
    protected $fillable = [
        'native_id', 'native_name','create_date','additional_info','createdby','updated_at','created_at'
    ];

    public function Member()
    {
        return $this->hasMany('App\Members', 'native');
    }

    public function getCreateDateAttribute($value){
        return Carbon::createFromFormat('Y-m-d', $value)->format('jS F Y');
    }
}
