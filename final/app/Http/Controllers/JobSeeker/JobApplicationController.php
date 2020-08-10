<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\JobApplication;
use App\JobSeeker;

class JobApplicationController extends Controller
{
    public function show($id){
        $app = JobApplication::findOrFail($id);

        Auth::guard('job_seeker')->check();

        return view('job_seeker.application.view', ['app'=> $app]);
    }

    public function edit(Request $request, $id){
        Auth::guard('job_seeker')->check();

        $app = JobApplication::findOrFail($id);
        $app -> message = $request['message'];
        $app -> save();

        return redirect('/job_seeker');


    }

    public function delete($id){
        Auth::guard('job_seeker')->check();

        $user = Auth::guard('job_seeker')->user();
        $app = JobApplication::findOrFail($id);

        if ($user -> id == $app -> job_seeker_id){
            $app -> delete();
            return redirect('/job_seeker');
        }
        else{
            return abort('404');
        }
    }
}
