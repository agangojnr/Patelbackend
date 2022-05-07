<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $table = 'payments';

    protected $fillable = ['payment_id','user_id','unique_id', 'amount_paid', 'payment_for', 'payment_ref', 'payment_method', 'received_by', 'payment_comment', 'date_received', 'date_verified'];

    public function member(){
        return $this->belongsTo(Members::class, 'user_id');
    }
}
