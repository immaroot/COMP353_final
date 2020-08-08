<?php

namespace App\Http\Controllers\Employer;

use App\JobApplication;
use App\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ApplicationsController extends Controller
{
    public function index($post_id)
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        $company = $employer->company();
        $job_post = JobPost::findOrFail($post_id);

        if (!$this->jobPostBelongsToCompanyAccount($job_post, $company))
        {
            return abort('404');
        }

        $applications = $job_post->applications;


        return view('employer.applications.index', ['applications' => $applications, 'job_post' => $job_post]);
    }

    public function show($id)
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        $company = $employer->company();
        $application = JobApplication::find($id);

        if (!$this->applicationBelongsToCompanyAccount($application, $company))
        {
            return abort('404');
        }

        return view('employer.applications.show', [
            'name' => 'joe', //$job_seeker->name,
            'email' => 'email@email.com', //$job_seeker->email,
            'phone' => '5555-555', //$job_seeker->phone,
            'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',
        ]);
    }

    public function userCanSeeApplication(Employer $user)
    {
        return $user->company()->company_manager_user_id == $user->id;
    }

    public function applicationBelongsToCompanyAccount($application, $company)
    {
        return $application->job_post->company_account_id == $company->id;
    }

    public function jobPostBelongsToCompanyAccount($job_post, $company)
    {
        return $job_post->company_account_id == $company->id;
    }
}
