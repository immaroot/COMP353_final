<?php

namespace App\Http\Controllers\Employer;

use App\CompanyAccount;
use App\Employer;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function index()
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();

        if (!$this->userCanManagePayments($employer))
        {
            return abort('404');
        }
        $payments = $employer->company()->payments();
        return view('employer.payments.index', ['payments' => $payments]);
    }

    public function userCanManagePayments(Employer $user)
    {
        return $user->company()->company_manager_user_id == $user->id;
    }
}
