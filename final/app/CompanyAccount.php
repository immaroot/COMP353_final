<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAccount extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'website', 'level',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Employer', 'works_for', 'company_account_id', 'user_id');
    }

    public function job_posts()
    {
        return $this->hasMany('App\JobPost');
    }

    public function payments()
    {
        return $this->belongsToMany('App\Payment', 'account_id');
    }

    public function whoIsAdmin()
    {
        return $this->company_manager_user_id;
    }
}
