<?php

namespace App\Http\Controllers\Auth;

use App\Employer;
use App\Http\Controllers\Controller;
use App\JobSeeker;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class JobSeekerRegisterController extends Controller
{
    use RegistersUsers;

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:job_seekers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function createJobSeeker(Request $request)
    {
        $this->validator($request->all())->validate();
        $job_seeker = JobSeeker::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        Auth::guard('job_seeker')->login($job_seeker);
        return redirect()->intended('job_seeker');
    }

    public function showJobSeekerRegisterForm()
    {
        return view('job_seeker.auth.register');
    }
}
