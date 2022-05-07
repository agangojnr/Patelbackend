<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = "announcements";

    protected $fillable = ['id','date','createdby','announcementtext','status','updated_at','created_at'];

    public function user(){
        return $this->belongsTo('App\User', 'createdby');
    }
}
