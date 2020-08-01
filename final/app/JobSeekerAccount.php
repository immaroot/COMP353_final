<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSeekerAccount extends Model
{
    protected $fillable = ['level', 'job_seeker_id'];

    public function user()
    {
        return $this->belongsTo('App\JobSeeker');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'account_id');
    }
}
