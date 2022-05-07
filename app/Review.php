<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    public $table = 'review';

    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $fillable = [
        'user_id',
        'branch_id',
        'booking_id',
        'star',
        'cmt',

    ];
    protected $appends = ['user'];
    public function getUserAttribute()
    {

        return AppUsers::find($this->attributes['user_id'], ['name', 'id', 'image']);
    }
    public function User()
    {
        return $this->belongsTo('App\AppUsers', 'user_id', 'id');
    }
    public function Branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id', 'id');
    }
}
