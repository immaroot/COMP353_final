<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\JobSeeker;
use App\JobSeekerAccount;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class JobSeekerRegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:employer')->except('logout');
        $this->middleware('guest:job_seeker')->except('logout');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'description' => 'required',
        ]);
    }

    protected function createJobSeeker(Request $request)
    {
        $this->validator($request->all())->validate();
        $job_seeker = JobSeeker::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => '1',
        ]);
        $account = JobSeekerAccount::create([
            'level' => $request['level'],
            'job_seeker_id' => $job_seeker->id,
            'description' => $request['description'],
        ]);
        Auth::guard('job_seeker')->login($job_seeker);
        return redirect()->intended('job_seeker');
    }

    public function showJobSeekerRegisterForm()
    {
        return view('job_seeker.auth.register');
    }
}
