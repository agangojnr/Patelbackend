<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingMaster extends Model
{
  
    protected $dates = [
        'created_at',
        'updated_at',
        'start_time',
        'end_time',
    ];
    protected $fillable = [
        'booking_id', 'user_id', 'branch_id', 'start_time', 'end_time', 'offer_id', 'total', 'discount', 'duration', 'status', 'payment_status', 'payment_token', 'payment_method',
    ];
    protected $appends = ['currency'];
    public $table = 'booking_master';
    public function getCurrencyAttribute()
    {
        return AdminSetting::first()->currency_symbol;
    }
    public function Offers()
    {
        return $this->hasMany('App\Offer', 'offer_id', 'id');
    }
    public function Branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id', 'id');
    }
    public function User()
    {
        return $this->belongsTo('App\AppUsers', 'user_id', 'id');
    }
    public function Services()
    {
        return $this->hasMany('App\BookingChild', 'booking_id', 'id');
    }
    public function Review()
    {
        return $this->hasOne('App\Review', 'booking_id', 'id');
    }
}
