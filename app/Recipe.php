<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = 'recipes';
    protected $fillable = ['id','date','description','picurl','createdby','ingredients','instructions','created_at','updated_at'];

    public function user(){
        return $this->belongsTo('App\User', 'createdby');
    }

}
