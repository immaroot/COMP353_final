<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSeeker extends User
{
    protected $table = 'users';

    protected $guard = 'job_seeker';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('role', 1);
        });
    }

    public function profile()
    {
        return $this->hasOne('App\JobSeekerAccount', 'job_seeker_id', 'id');
    }

    public function description()
    {
        return $this->profile->description;
    }

    public function applications()
    {
        return $this->hasMany('App\JobApplication', 'job_seeker_id', 'id');
    }

    public function payment_methods()
    {
        return PaymentMethod::where('account_id', $this->id)->where('account_role', '1')->get();
    }
}
