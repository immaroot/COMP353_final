<?php

namespace App\Http\Controllers\Auth;

use App\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployerRegisterController extends Controller
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function createEmployer(Request $request)
    {
        $this->validator($request->all())->validate();
        $employer = Employer::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        Auth::guard('employer')->login($employer);
        return redirect()->intended('employer');
    }

    protected function create(array $data)
    {
        dd($data);
        return Employer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showEmployerRegisterForm()
    {
        return view('employer.auth.register');
    }
}
