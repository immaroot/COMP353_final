<?php

namespace App\Http\Controllers\Employer;

use App\JobApplication;
use App\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ApplicationsController extends Controller
{
    public function summary()
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        $company = $employer->company();

        $job_posts = $company->job_posts;
        foreach ($job_posts as $job_post)
        {
            $applicants = $job_post->applications->count();
            $job_post->applicants_count = $applicants;
        }

        return view('employer.applications.summary', ['job_posts' => $job_posts]);
    }

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

    public function show($post_id, $application_id)
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        $company = $employer->company();
        $job_post = JobPost::findOrFail($post_id);
        $application = JobApplication::findOrFail($application_id);

        if (!$this->jobPostBelongsToCompanyAccount($job_post, $company))
        {
            return abort('404');
        }

        if (!$this->applicationBelongsToCompanyAccount($application, $company))
        {
            return abort('404');
        }

        return view('employer.applications.show', ['application' => $application, 'job_post' => $job_post]);
    }


    public function update($post_id, $application_id, Request $request)
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        $company = $employer->company();
        $job_post = JobPost::findOrFail($post_id);
        $application = JobApplication::findOrFail($application_id);

        if (!$this->jobPostBelongsToCompanyAccount($job_post, $company))
        {
            return abort('404');
        }

        if (!$this->applicationBelongsToCompanyAccount($application, $company))
        {
            return abort('404');
        }

        $request->validate([
            'application_status' => 'required',
        ]);

        if ($request['application_status'] == 'being reviewed')
            $application->status = 0;

        if ($request['application_status'] == 'accepted')
            $application->status = 1;

        if ($request['application_status'] == 'denied')
            $application->status = 2;

        $application->save();

        return redirect('employer/applications/' . $job_post->id);
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
