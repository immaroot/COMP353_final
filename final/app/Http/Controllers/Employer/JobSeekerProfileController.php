<?php

namespace App\Http\Controllers\Employer;

use App\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class JobSeekerProfileController extends Controller
{
    public function show($id)
    {
        Auth::guard('employer')->check();

        $job_seeker = JobSeeker::findOrFail($id);

        return view('employer.view_profile.show', [
            'name' => 'joe', //$job_seeker->name,
            'email' => 'email@email.com', //$job_seeker->email,
            'phone' => '5555-555', //$job_seeker->phone,
            'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',
        ]);
    }
}
