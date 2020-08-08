<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function show()
    {
        Auth::guard('job_seeker')->check();
        $user = Auth::guard('job_seeker')->user();

        $applications = $user->job_applications();

        return view('job_seeker.dashboard', [
            'job_applications' => $job_applications,
        ]);
    }
}
