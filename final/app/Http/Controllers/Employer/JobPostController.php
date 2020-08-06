<?php

namespace App\Http\Controllers\Employer;

use App\CompanyAccount;
use App\Employer;
use App\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class JobPostController extends Controller
{
    public function store(Request $request)
    {
        Auth::guard('employer')->check();

        $employer = Employer::findOrfail(Auth::guard('employer')->user()->id);
        $job_post = new JobPost();
        $job_post->company_account_id = $employer->company()->id;
        $job_post->employer_id = $employer->id;

        $request->validate([
            'position' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);

        $job_post->position = $request['position'];
        $job_post->description = $request['description'];
        $job_post->job_category_id = $request['category'];

        $job_post->save();

        return view('employer.posts.view', [
            'job_id' => $job_post->id,
            'company_name' => 'test',
            'position' => $job_post->position,
            'description' => $job_post->description,
        ]);
    }

    public function show($id)
    {
        Auth::guard('employer')->check();

        $job_post = JobPost::findOrFail($id);

        return view('employer.posts.view', [
            'job_id' => $job_post->id,
            'company_name' => $job_post->company->name,
            'position' => $job_post->position,
            'description' => $job_post->description,
        ]);
    }

    public function edit($id)
    {
        Auth::guard('employer')->check();

        $job_post = JobPost::findOrFail($id);
        $user = Auth::guard('employer')->user();
        if (!$this->userCanEdit($user, $job_post))
        {
            return abort('404');
        }
        return view('employer.posts.edit', [
            'job_id' => $id,
            'position' => $job_post->position,
            'description' => $job_post->description,
            'category' => $job_post->job_category_id,
        ]);
    }

    public function update(Request $request)
    {
        Auth::guard('employer')->check();

        $job_post = JobPost::findOrFail($request['job_id']);
        $user = Auth::guard('employer')->user();
        if (!$this->userCanEdit($user, $job_post))
        {
            return abort('404');
        }
        $request->validate([
            'job_id' => 'required',
            'position' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);

        $job_post->position = $request['position'];
        $job_post->description = $request['description'];
        $job_post->job_category_id = $request['category'];
        $job_post->save();

        return redirect('employer/job_posts/');
    }

    public function index()
    {
        Auth::guard('employer')->check();

        $company = CompanyAccount::find(Auth::guard('employer')->user()->company()->id);

        $job_posts = $company->job_posts;

        return view('employer.posts.index', compact('job_posts'));
    }

    public function create()
    {
        Auth::guard('employer')->check();

        return view('employer.posts.create');
    }

    public function destroy($id)
    {
        Auth::guard('employer')->check();

        $job_post = JobPost::findOrFail($id);
        $user = Auth::guard('employer')->user();
        if (!$this->userCanEdit($user, $job_post))
        {
            return abort('404');
        }

        $job_post->destroy();

        return $this->index();
    }

    protected function userCanEdit(Employer $user, JobPost $job_post)
    {
        return $user->company()->id == $job_post->company->id;
    }

}