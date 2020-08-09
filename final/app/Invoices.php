<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    public function account()
    {
        if($this->account_role == 1)
        {
            return CompanyAccount::find($this->account_id);
        }
        elseif($this->account_role == 2)
        {
            return CompanyAccount::find($this->account_id);
        }
        else {
            return false;
        }
    }
}
