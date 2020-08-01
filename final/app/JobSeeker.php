<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSeeker extends User
{
    protected $table = 'users';

    protected $guard = 'employer';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('role', 1);
        });
    }
}
