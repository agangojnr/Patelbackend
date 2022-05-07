<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    public $table = 'main_sports';
    protected $fillable = [
        'sport_id', 'sport_name','sport_comment',
    ];
}
