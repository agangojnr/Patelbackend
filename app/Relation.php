<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    public $table = 'relation';
    protected $fillable = [
        'relation_id', 'relation_desc',
    ];
}
