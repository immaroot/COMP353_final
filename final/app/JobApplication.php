<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    public function job_seeker()
    {
        return $this->hasOne('App\JobSeeker', 'id', 'job_seeker_id');
    }

    public function job_post()
    {
        return $this->belongsTo('App\JobPost');
    }

    public function application_status()
    {
        return $this->hasOne('App\ApplicationStatus', 'id', 'status');
    }
}
