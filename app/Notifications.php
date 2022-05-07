<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{

    public $table = 'notification_tbl';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'booking_id', 'user_id', 'sender_id', 'title', 'sub_title',
    ];
    public function getOwnerAttribute()
    {
        return Branch::find($this->attributes['sender_id'], ['id', 'name', 'image']);
    }
    public function getUserAttribute()
    {
        return AppUsers::find($this->attributes['sender_id'], ['id', 'name', 'image']);
    }
}
