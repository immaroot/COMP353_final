<?php

namespace App\Http\Controllers\JobSeeker;

use App\CompanyAccount;
use App\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show()
    {
        Auth::guard('job_seeker')->check();
        $user = Auth::guard('job_seeker')->user;

        return view ('job_seeker.profile.view', [
            'name' => $user->name,
            'description' => $user -> description()
        ]);
    }
}