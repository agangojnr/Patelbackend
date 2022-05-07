<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Members;

class Town extends Model
{
   public $table = 'towns';
    protected $fillable = [
        'town_id', 'town_name', 'center_id', 'town_code'
    ];

public function centre()
    {
        return $this->hasOne('App\Center', 'id', 'center_id');
    }
public function member(){
    return $this->hasMany(Members::class, 'town','town_id' );
}

}
