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
        $user = Auth::guard('job_seeker')->user();

        $profile = $user -> profile() -> firstOrFail();

        return view ('job_seeker.profile.view', [
            'name' => $user->name,
            'description' => $user -> description(),
            'membership' => $profile -> level,
            'email' => $user -> email
        ]);
    }

    public function edit(){
        Auth::guard('job_seeker')->check();
        $user = Auth::guard('job_seeker')->user();

        return view('job_seeker.profile.edit', [
            'name' => $user->name,
            'description' => $user->description(),
            'email' => $user->email,
        ]);

    }

    public function update(Request $request){
        Auth::guard('job_seeker')->check();
        $user = Auth::guard('job_seeker')->user();

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'email' => 'required'
        ]);

        $user -> name = $request['name'];
        $user -> email = $request['email'];

        $prof = $user -> profile() -> firstOrFail();
        $prof -> description = $request['description'];

        $user -> save();
        $prof -> save();

        return redirect('job_seeker/account');

    }

    public function edit_level(){
        Auth::guard('job_seeker')->check();
        $user = Auth::guard('job_seeker')->user();

        return view('job_seeker.profile.edit_level', [
            'account_level' => $user->level
        ]);
    }

    public function save_level(Request $request){
        Auth::guard('job_seeker')->check();
        $user = Auth::guard('job_seeker')->user();

        $profile = $user -> profile() -> firstOrFail();

        $request->validate([
            'membership' => 'required',
        ]);

        if ($request['membership'] == 'basic')
            $profile->level = 0;

        elseif ($request['membership'] == 'prime')
            $profile->level = 1;

        elseif ($request['membership'] == 'gold')
            $profile->level = 2;

        $profile -> save();

        return redirect('job_seeker/account');

    }
}