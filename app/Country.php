<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $table = 'country';
    protected $fillable = [
        'id', 'country_name', 'country_code',
    ];

    public function Member()
    {
        return $this->hasMany('App\Members', 'country');
    }

    public function center()
    {
        return $this->hasMany('App\Center', 'country_id');
    }
}
