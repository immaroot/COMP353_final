<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    public function job_seeker()
    {
        return $this->belongsTo('App\JobSeeker');
    }

    public function job_post()
    {
        return $this->belongsTo('App\JobPost');
    }
}
