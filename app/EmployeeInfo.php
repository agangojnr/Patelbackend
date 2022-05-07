<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeInfo extends Model
{

    public $table = 'employee_detail';

    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $fillable = [
        'emp_id', 'address', 'description', 'service', 'icon', 'experience', 'status',
    ];

    protected $appends = ['imageUri', 'avg_rating'];
    public function setServiceAttribute($value)
    {
        $this->attributes['service'] = implode(',', $value);
    }

    public function getServiceAttribute($value)
    {
        return explode(',', $value);
    }
    public function getImageUriAttribute()
    {
        if (isset($this->attributes['icon'])) {

            return url('upload/') . '/' . $this->attributes['icon'];
        }
    }
    public function User()
    {
        return $this->belongsTo('App\User', 'emp_id', 'id');
    }
    public function getAvgRatingAttribute()
    {
        return 4;
        $revData = Review::where('provider_id', $this->attributes['id'])->get();
        $star = $revData->sum('star');

        if ($star > 1) {
            $t = $star / count($revData);

            return number_format($t, 1, '.', '');
        }
        return 'N/A';
    }

}
