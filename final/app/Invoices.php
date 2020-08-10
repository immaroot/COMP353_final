<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    public function account()
    {
        if($this->account_role == 1)
        {
            return JobSeekerAccount::find($this->account_id);
        }
        elseif($this->account_role == 2)
        {
            return CompanyAccount::find($this->account_id);
        }
        else {
            return false;
        }
    }

    public function is_paid()
    {
        return !$this->payment_id == null;
    }

    public function diff_days()
    {
        $now = Carbon::now();
        return $this->created_at->diffInDays($now);
    }
}
