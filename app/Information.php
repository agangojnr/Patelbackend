<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'information';

    protected $fillable = ['id','subject','description','venue','date','createdby','created_at',
    'updated_at'];

    public function user(){
        return $this->belongsTo('App\User', 'createdby');
    }

    public function userinformation(){
        return $this->hasOne('App\UserNotification', 'info_id');
    }


}
