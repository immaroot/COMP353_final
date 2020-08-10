<?php

namespace App\Http\Middleware;

use App\Employer;
use App\JobSeeker;
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
            if (!$employer->company()->current_invoice()->is_paid())
            {
                return redirect('employer/payments/make');
            }else{
                return $response;
            }
        }elseif (Auth::guard('job_seeker')->check())
        {
            $job_seeker = JobSeeker::find(Auth::guard('job_seeker')->user()->id);
            if (!$job_seeker->profile()->current_invoice()->is_paid())
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
