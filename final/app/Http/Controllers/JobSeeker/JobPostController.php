<?php

namespace App\Http\Controllers\JobSeeker;

use App\JobApplication;
use App\JobPost;

use App\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class JobPostController extends Controller
{
    public function index()
    {
        $job_posts = JobPost::all();

        return view('job_seeker.posts.index', ['job_posts' => $job_posts]);
    }

    public function show($post_id)
    {

        $job_post = JobPost::findOrFail($post_id);

        Auth::guard('job_seeker')->check();

        $job_seeker = JobSeeker::findOrfail(Auth::guard('job_seeker')->user()->id);

        return view('job_seeker.posts.apply', ['job_post' => $job_post, 'job_seeker' => $job_seeker]);
    }

    public function apply($post_id, Request $request)
    {
        $job_post = JobPost::findOrFail($post_id);

        Auth::guard('job_seeker')->check();

        $job_seeker = JobSeeker::findOrfail(Auth::guard('job_seeker')->user()->id);

        $application = new JobApplication();
        $application->job_seeker_id = $job_seeker->id;
        $application->job_post_id = $job_post->id;

        $request->validate([
            'message' => 'required',
        ]);

        $application->message = $request['message'];
        $application->status = 0;

        $application->save();

        return redirect('job_seeker/job_posts');
    }
}
