<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberRequest extends Model
{
    protected $table = 'requests';

    protected $fillable = ['id','date','category','description','response_date','response','responded_by','user_id','status','created_at','created_at'];

    public function member(){
        return $this->belongsTo('App\Members', 'user_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
