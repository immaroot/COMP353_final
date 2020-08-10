<?php

namespace App\Http\Controllers\Employer;

use App\CompanyAccount;
use App\Employer;
use App\Invoices;
use App\Payment;
use App\PaymentMethod;
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

    public function makePayment()
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();

        $invoice = $employer->company()->current_invoice();

        $payment_methods = $employer->company()->payment_methods();

        if (!$this->userCanManagePayments($employer))
        {
            return abort('404');
        }

        return view('employer.payments.make', ['invoice' => $invoice, 'payment_methods' => $payment_methods]);

    }

    public function processPayment(Request $request)
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();

        $invoice = Invoices::find($request['invoice_id']);

        $payment_method = PaymentMethod::find($request['payment_method']);

        if (!$this->userCanManagePayments($employer) || !$this->paymentMethodBelongsToCompanyAccount($employer, $payment_method))
        {
            return abort('404');
        }

        $payment = new Payment();
        $payment->amount = $invoice->amount;
        $payment->account_id = $employer->company()->id;
        $payment->account_role = 2;
        $payment->method = $payment_method->method;
        $payment->card_number = $payment_method->card_number;
        $payment->was_automatic = $payment_method->is_automatic;
        $payment->save();

        $invoice->payment_id = $payment->id;
        $invoice->save();

        return redirect('employer');

    }

    public function paymentMethodBelongsToCompanyAccount($employer, $payment_method)
    {
        return $employer->company()->payment_methods()->contains($payment_method);
    }

}
