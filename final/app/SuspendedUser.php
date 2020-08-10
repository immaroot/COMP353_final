<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuspendedUser extends User
{
    protected $table = 'users';

    protected $guard = 'suspended';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('suspended', 1);
        });
    }
}
