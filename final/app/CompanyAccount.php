<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAccount extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'website', 'level', 'company_manager_user_id',
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
        return Payment::where('account_id', $this->id)->where('account_role', '2')->get();
    }

    public function invoices()
    {
        return Invoices::where('account_id', $this->id)->where('account_role', '2')->get();
    }

    public function current_invoice()
    {
        return Invoices::where('account_id', $this->id)->where('account_role', '2')->orderBy('created_at', 'desc')->first();
    }

    public function payment_methods()
    {
        return PaymentMethod::where('account_id', $this->id)->where('account_role', '2')->get();
    }

    public function canPostJob()
    {
        if ($this->level == 1 && $this->currentJobListingsCount() < 5)
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

    public function currentJobListingsCount()
    {
        return $this->job_posts()->where('status', '0')->count();
    }

    public function whoIsAdmin()
    {
        return $this->company_manager_user_id;
    }
}
