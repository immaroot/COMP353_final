<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function show()
    {
        Auth::guard('job_seeker')->check();
        $user = Auth::guard('job_seeker')->user();

        $applications = $user->applications;

        return view('job_seeker.dashboard', ['applications' => $applications]);
    }
}
