<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $table = 'job_posts';

    protected $fillable = [
        'id', 'title_id', 'job_requirements', 'job_qualifications', 'experience','no_of_vacancies','appln_deadline','contact',
        'email','createdby','response_info','response_date','responded_by','status','created_at','updated_at'
    ];

    public function appuser(){
        return $this->belongsTo('App\AppUsers', 'createdby');
    }

    public function Jobtitle(){
        return $this->belongsTo('App\JobTitle', 'title_id');
    }
}
