<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function job_seeker_account()
    {
        return $this->belongsTo('App\JobSeekerAccount', 'account_id');
    }

    public function employer_account()
    {
        return $this->belongsTo('App\EmployerAccount', 'account_id');
    }
}
