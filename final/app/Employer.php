<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\WorksFor;

class Employer extends User
{
    protected $table = 'users';

    protected $guard = 'employer';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('role', 2);
        });
    }

    public function company()
    {
        return $this->belongsToMany('App\CompanyAccount', 'works_for','user_id','company_account_id')->first();
    }

    public function isAdmin()
    {
        return $this->company()->whoIsAdmin() == $this->id;
    }
}
