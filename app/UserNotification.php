<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = "user_notification";

    protected $fillable = ['id','user_id','info_id','created_at','updated_at'];

    public function appuser(){
        return $this->belongsTo('App\AppUsers', 'user_id');
    }


}
