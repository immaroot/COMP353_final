<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSeekerAccount extends Model
{
    protected $fillable = ['level', 'job_seeker_id', 'description'];

    public function user()
    {
        return $this->belongsTo('App\JobSeeker');
    }

    public function payments()
    {
        return Payment::where('account_id', $this->id)->where('account_role', '2')->get();
    }

    public function payment_methods()
    {
        return PaymentMethod::where('account_id', $this->id)->where('account_role', '2')->get();
    }
}
