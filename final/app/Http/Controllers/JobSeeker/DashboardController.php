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

        $applications = $user->applications();

        $app_details = [];

        //if no job post found, it deletes the application
        foreach ($applications as $app){
            $app_details[] = $app->job_post()->firstOr(function(){
                $app->delete();
            });
        }

        return view('job_seeker.dashboard', ['applications' => $applications,'details' => $app_details]);
    }
}
