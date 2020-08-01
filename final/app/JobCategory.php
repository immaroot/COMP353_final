<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    public function job_posts()
    {
        return $this->hasMany('App\JobPost');
    }
}
