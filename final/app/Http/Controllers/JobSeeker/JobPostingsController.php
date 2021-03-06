<?php

namespace App\Http\Controllers\JobSeeker;

use App\CompanyAccount;
use App\JobSeeker;
use App\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JobPostingsController extends Controller
{
   
    public function index()
    {
        Auth::guard('job_seeker')->check();

        $user = Auth::guard('job_seeker')->user();

        $jobPostings = DB::table('job_posts')
        ->join('job_categories', 'job_categories.id', '=', 'job_posts.job_category_id')
        ->where('status', 0)->get();
        //

        return view('job_seeker.jobPostings.index', ['jobPostings' => $jobPostings]);
    }
}
