<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    protected $table = "committees";

    protected $fillable = ['id','chairperson','vicechairperson','secretary','asssecretary','treasurer','asstreasurer','year','createdby','created_at',
    'updated_at'];

    public function user(){
        return $this->belongsTo('App\User', 'createdby');
    }
}
