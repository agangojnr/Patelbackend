<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    public $table = 'insurance';
    protected $fillable = [
        'user_id', 'insurance_co', 'policy_no', 'expiry', 'assigned'
    ];
}
