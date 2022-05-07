<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{

    use SoftDeletes;
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = [];
    public function setBranchIdAttribute($value)
    {
        $this->attributes['branch_id'] = implode(',', $value);
    }
    public function getBranchDataAttribute()
    {
        return Branch::whereIn('id', explode(',', $this->attributes['branch_id']))->where('status', 1)->get(['id', 'name', 'status']);
    }
    public function getBranchIdAttribute($value)
    {
        return explode(',', $value);
    }
}
