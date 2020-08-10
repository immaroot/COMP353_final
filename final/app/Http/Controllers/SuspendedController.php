<?php

namespace App\Http\Controllers;

use App\Employer;
use App\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuspendedController extends Controller
{
    public function index()
    {

        if (Auth::guard('employer')->check())
        {
            return view('payment_needed.payment', ['user' => Auth::guard('employer')->user()->id]);
        }elseif (Auth::guard('job_seeker')->check())
        {
            return view('payment_needed.payment', ['user' => 'job_seeker']);
        }else{
            abort('404');
        }
    }

    public function show(Request $request)
    {
        return view('payment_needed.payment', ['data' => Auth::guard('employer')->check()]);
    }
}
