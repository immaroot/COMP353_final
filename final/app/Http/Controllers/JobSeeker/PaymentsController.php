<?php

namespace App\Http\Controllers\JobSeeker;

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
        Auth::guard('job_seeker')->check();

        $job_seeker = Auth::guard('job_seeker')->user();

        $payments = $job_seeker->profile->payments();
        return view('job_seeker.payments.index', ['payments' => $payments]);
    }

    public function makePayment()
    {
        Auth::guard('job_seeker')->check();

        $job_seeker = Auth::guard('job_seeker')->user();

        $invoice = $job_seeker->profile->current_invoice();

        $payment_methods = $job_seeker->profile->payment_methods();

        return view('job_seeker.payments.make', ['invoice' => $invoice, 'payment_methods' => $payment_methods]);

    }

    public function processPayment(Request $request)
    {
        Auth::guard('job_seeker')->check();

        $job_seeker = Auth::guard('job_seeker')->user();

        $invoice = Invoices::find($request['invoice_id']);

        $payment_method = PaymentMethod::find($request['payment_method']);

        if (!$this->paymentMethodBelongsToProfile($job_seeker, $payment_method))
        {
            return abort('404');
        }

        $payment = new Payment();
        $payment->amount = $invoice->amount;
        $payment->account_id = $job_seeker->profile->id;
        $payment->account_role = 2;
        $payment->method = $payment_method->method;
        $payment->card_number = $payment_method->card_number;
        $payment->was_automatic = $payment_method->is_automatic;
        $payment->save();

        $invoice->payment_id = $payment->id;
        $invoice->save();

        return redirect('job_seeker');

    }

    public function paymentMethodBelongsToProfile($job_seeker, $payment_method)
    {
        return $job_seeker->profile->payment_methods()->contains($payment_method);
    }

}
