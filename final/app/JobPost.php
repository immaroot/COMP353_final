<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $fillable = [
        'position', 'description', 'job_category_id', 'salary'
    ];

    public function company()
    {
        return $this->belongsTo('App\CompanyAccount', 'company_account_id');
    }

    public function employer()
    {
        return $this->belongsTo('App\Employer');
    }

    public function applications()
    {
        return $this->hasMany('App\JobApplication');
    }

    public function category()
    {
        return $this->hasOne('App\JobCategory', 'id', 'job_category_id');
    }

    public function job_status()
    {
        return $this->hasOne('App\JobStatus', 'id', 'status');
    }
}
