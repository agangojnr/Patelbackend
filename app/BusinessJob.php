<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessJob extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'last_date',
        
    ];
    protected $fillable = [
        'bus_job_id', 'businee_or_job', 'bus_job_cat_id', 'title', 'short_description', 'long_decription', 'bus_job_type', 'business_job_name', 'business_job_location', 'user_id', 'phone_number', 'email_address', 'vacancy', 'image_url', 'last_date',
    ];

    public $table = 'busine_jobs';

    public function Busjobcategory()
    {
        return $this->hasOne('App\BusinessJobCategory', 'cat_id', 'bus_job_cat_id');
    }

    
}
