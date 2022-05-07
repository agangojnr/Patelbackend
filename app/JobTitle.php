<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    protected $table = 'job_titles';

    protected $fillable = [
        'id', 'title', 'title_description', 'sector_id', 'created_by','created_at','updated_at'
    ];

    public function user()
    {
        return $this->BelongsTo('App\User', 'created_by');
    }

    public function Businesssector()
    {
        return $this->BelongsTo('App\BusinessSector', 'sector_id');
    }

    public function Jobpost()
    {
        return $this->hasMany('App\JobPost', 'sector_id');
    }
}
