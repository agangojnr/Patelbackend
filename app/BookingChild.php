<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingChild extends Model
{

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $guarded = [];
    public $table = 'booking_child';
    public function Service()
    {
        return $this->belongsTo('App\SubCategory', 'service_id', 'id');
    }
    public function Employee()
    {
        return $this->belongsTo('App\User', 'emp_id', 'id');
    }
}
