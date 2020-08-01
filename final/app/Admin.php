<?php

namespace App;


class Admin extends User
{
    protected $table = 'users';

    protected $guard = 'admin';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('role', 0);
        });
    }

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
