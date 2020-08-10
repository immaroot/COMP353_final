<?php

namespace App\Http\Middleware;

use App\Employer;
use App\Invoices;
use App\JobSeeker;
use App\Payment;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckInvoiceDue
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (Auth::guard('employer')->check())
        {
            $employer = Employer::find(Auth::guard('employer')->user()->id);

            if ($employer->company()->current_invoice() != null && $employer->company()->current_invoice()->diff_days() > 30)
            {
                $invoice = new Invoices();
                if ($employer->company()->level == 1){
                    $amount = 50.00;
                }elseif ($employer->company()->level == 2)
                {
                    $amount = 100.00;
                }
                $invoice->amount = $amount;
                $invoice->account_id = $employer->company()->id;
                $invoice->account_role = 2;
                $invoice->save();
            }

            if ($employer->company()->auto_payment() != null)
            {
                $invoice = $employer->company()->current_invoice();
                $payment_method = $employer->company()->auto_payment();

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
            }

            if ($employer->company()->current_invoice() != null && !$employer->company()->current_invoice()->is_paid())
            {
                return redirect('employer/payments/make');
            }else{
                return $response;
            }
        }elseif (Auth::guard('job_seeker')->check())
        {
            $job_seeker = JobSeeker::find(Auth::guard('job_seeker')->user()->id);

            if ($job_seeker->profile->current_invoice() != null && $job_seeker->profile->current_invoice()->diff_days() > 30)
            {
                if ($job_seeker->profile->level != 0)
                {
                    $invoice = new Invoices();
                    if ($job_seeker->profile->level == 1){
                        $amount = 10.00;
                    }elseif ($job_seeker->profile->level == 2)
                    {
                        $amount = 20.00;
                    }else{

                    }
                    $invoice->amount = $amount;
                    $invoice->account_id = $job_seeker->profile->id;
                    $invoice->account_role = 1;
                    $invoice->save();
                }

            }

            if ($job_seeker->profile->auto_payment() != null)
            {
                $invoice = $job_seeker->profile->current_invoice();
                $payment_method = $job_seeker->profile->auto_payment();

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
            }
            if ($job_seeker->profile->current_invoice() != null && !$job_seeker->profile->current_invoice()->is_paid())
            {
                return redirect('job_seeker/payments/make');
            }else{
                return $response;
            }
        }else{

            return $response;

        }
    }
}
