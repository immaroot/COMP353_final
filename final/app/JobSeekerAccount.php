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

    public function invoices()
    {
        return Invoices::where('account_id', $this->id)->where('account_role', '1')->get();
    }

    public function current_invoice()
    {
        return Invoices::where('account_id', $this->id)->where('account_role', '1')->orderBy('created_at', 'desc')->first();
    }

    public function applications()
    {
        return $this->user()->applications;
    }

    public function currentApplicationCount()
    {
        return $this->applications()->where('status', '0')->count();
    }

    public function canApplyJob()
    {
        if ($this->level == 1 && $this->currentApplicationCount() < 5)
        {
            return true;
        }
        elseif ($this->level == 2)
        {
            return true;
        }else{
            return false;
        }
    }

}
